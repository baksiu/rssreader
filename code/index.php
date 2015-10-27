<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"

  "http://www.w3.org/TR/html4/strict.dtd">

<?php 

	include("rssreader.php");
	session_start(); 
	if (!isset($_SESSION['lform'])) 
	{
		$_SESSION['lform'] = 0;
	} 
	if (!isset($_SESSION['tablica'])) 
	{
		$_SESSION['tablica'][][] = null;
	}
	if (!isset($_SESSION['uprawnienia'])) 
	{
		$_SESSION['uprawnienia'] = 0;
	}
	function connectdb()
	{
		$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
		$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
	}
	
	function validation()
	{
		$val_imie = (!empty($_POST['imie']));
		$val_nazwisko = (!empty($_POST['nazwisko']));
		$val_plec = (!empty($_POST['sex']));
		$val_kpoczt = (!empty($_POST['kod_poczt']) && preg_match('/^[0-9]{2}-?[0-9]{3}$/Du',$_POST['kod_poczt']));
		$val_mail = (!empty($_POST['mail']) && preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $_POST['mail']));
		echo $val_imie;
		echo $val_nazwisko;
		echo $val_plec;
		echo $val_kpoczt;
		echo $val_mail;
	}
?>

<html lang="pl">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
  <title>systemy_internetowe</title>
  <link rel="Stylesheet" type="text/css" href="style.css"/>

</head>

<body>
<div id = "zew">
	<div id = "up">
		up
	</div>
	<div id = "left">
		<ul class="menu_lewe">
		<?php
		if($_SESSION['uprawnienia'] == 0)
		{
			echo "
				<li><a href=index.php?id=1>Strona g³ówna </a></li>;
				<li><a href=index.php?id=14&actpage=1>RSS Reader</a></li>";
		}
		if($_SESSION['uprawnienia'] == 1)
		{
			echo "
				<li><a href=index.php?id=1>Strona g³ówna </a></li>
				<li><a href=index.php?id=2>Formularz </a></li>
				<li><a href=index.php?id=3>Zawartoœæ sesji</a></li>
				<li><a href=index.php?id=4&actnum=0>Baza danych</a></li>";
		}
		if($_SESSION['uprawnienia'] == 2)
		{
			echo "
				<li><a href=index.php?id=1>Strona g³ówna </a></li>
				<li><a href=index.php?id=2>Formularz </a></li>
				<li><a href=index.php?id=3>Zawartoœæ sesji</a></li>
				<li><a href=index.php?id=4&actnum=0>Baza danych</a></li>			
				<li><a href=index.php?id=5&actnum=0>Edycja pracownika</a></li>";
		}
		if($_SESSION['uprawnienia'] == 3)
		{
			echo "
				<li><a href=index.php?id=1>Strona g³ówna </a></li>
				<li><a href=index.php?id=2>Formularz </a></li>
				<li><a href=index.php?id=3>Zawartoœæ sesji</a></li>
				<li><a href=index.php?id=4&actnum=0>Baza danych</a></li>			
				<li><a href=index.php?id=5&actnum=0>Edycja pracownika</a></li>
				<li><a href=index.php?id=6&actnum=0>Usuniêcie pracownika</a></li>";
		}
		if($_SESSION['uprawnienia'] == 4)
		{
			echo "
				<li><a href=index.php?id=1>Strona g³ówna </a></li>
				<li><a href=index.php?id=2>Formularz </a></li>
				<li><a href=index.php?id=3>Zawartoœæ sesji</a></li>
				<li><a href=index.php?id=4&actnum=0>Baza danych</a></li>			
				<li><a href=index.php?id=5&actnum=0>Edycja pracownika</a></li>
				<li><a href=index.php?id=6&actnum=0>Usuniêcie pracownika</a></li>
				<li><a href=index.php?id=11&actnum=0>Zmiana danych</a></li>
				<li><a href=index.php?id=12&actnum=0>Zmiana poziomu dostêpu</a></li>
				<li><a href=index.php?id=13&actnum=0>Usuniêcie u¿ytkownika</a></li>";
		}
		?>
		</ul>
	</div>
	<div id = "middle">
		<?php
		if (isset($_GET['id']))
		{
			switch($_GET['id'])
			{
				case 1:
					echo "Strona g³ówna.<br>";
					if(isset($_SESSION['login']))
					{
						echo "Witaj ";
						echo $_SESSION['imie'];
						echo " ";
						echo $_SESSION['nazwisko'];
						echo ".<br>";
					}
				break;
				case 2:
					if(isset($_POST['formularz']))
					{
							$val_imie = (!empty($_POST['imie']));
							$val_nazwisko = (!empty($_POST['nazwisko']));
							$val_plec = (!empty($_POST['sex']));
							$val_kpoczt = (!empty($_POST['kod_poczt']) && preg_match('/^[0-9]{2}-?[0-9]{3}$/Du',$_POST['kod_poczt']));
							$val_mail = (!empty($_POST['mail']) && preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $_POST['mail']));
							
							if($val_imie == 1)
							{
							}
							else
							{
								echo "Nie podano imienia.</br>";
							}
							if($val_nazwisko == 1)
							{
							}
							else
							{
								echo "Nie podano nazwiska.</br>";
							}
							if($val_plec == 1)
							{
								$selected = $_POST['sex'];
							}
							else
							{
								echo "Nie podano p³ci.</br>";
							}
							if($val_kpoczt == 1)
							{
							}
							else
							{
								echo "Niepoprawny kod pocztowy.</br>";
							}
							if($val_mail == 1)
							{
							}
							else
							{
								echo "Niepoprawny adres email.</br>";
							}
							if(($val_imie && $val_nazwisko && $val_kpoczt && $val_mail & $val_plec) == 1)
							{
								$_SESSION['tablica'][$_SESSION['lform']][0] = $_POST['imie'];
								$_SESSION['tablica'][$_SESSION['lform']][1] = $_POST['nazwisko'];
								if($_POST['sex'] == m)
								{
									$_SESSION['tablica'][$_SESSION['lform']][2] = mê¿czyzna;
								}
								if($_POST['sex'] == k)
								{
									$_SESSION['tablica'][$_SESSION['lform']][2] = kobieta;
								}
								$_SESSION['tablica'][$_SESSION['lform']][3] = $_POST['nazwisko_pan'];
								$_SESSION['tablica'][$_SESSION['lform']][4] = $_POST['kod_poczt'];
								$_SESSION['tablica'][$_SESSION['lform']][5] = $_POST['mail'];
								$_SESSION['lform'] = $_SESSION['lform'] + 1;
								
								$imie = $_POST['imie'];
								$nazw = $_POST['nazwisko'];
								if($_POST['sex'] == m)
								{
									$plec = m;
								}
								if($_POST['sex'] == k)
								{
									$plec = k;
								}
								$npan = $_POST['nazwisko_pan'];
								$kpocz = $_POST['kod_poczt'];
								$mail = $_POST['mail'];
								
								$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
								$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
								
								$sql = "INSERT INTO pracownik (imie,nazwisko,plec,npan,kpoczt,mail) VALUES ('$imie','$nazw','$plec','$npan','$kpocz','$mail')";
								if (mysql_query($sql) == TRUE) 
								{
									echo "New record created successfully</br>";
									header("Location:index.php?id=3");
								} 
								else 
								{
									echo "Error: " . $sql . "<br>" . $connect->error;
								}
								mysql_close($connect);
							}
					}
					//echo "<form action=formularz.php method=post>
					//<table id=center>
                    //    <tr>
                    //            <td>Imiê: </td><td><input type=text name=imie value='";if(!empty($_SESSION['tablica'][$_SESSION['lform']])) { print_r($_SESSION['tablica'][$_SESSION['lform']][0]);}
					//echo "'></td>
					echo 
						"<form action=index.php?id=2 method=post>
							<table id=center>
								<tr>				
									<td>Imiê: </td><td><input type=text name=imie value='";if(!empty($_POST['imie'])){print_r($_POST['imie']);} echo"'></td>
								</tr>
								<tr>	
									<td>Nazwisko: </td><td><input type=text name=nazwisko value='";if(!empty($_POST['nazwisko'])){print_r($_POST['nazwisko']);} echo"'></td>
								</tr>
								<tr>
									<td>P³eæ</td>
									<td>";
									if(!empty($_POST['sex']) && $selected == m)
									{ 
										echo"<input type=radio name=sex value=m checked=checked>Mê¿czyzna<br>";
									}
									else
									{
										echo"<input type=radio name=sex value=m>Mê¿czyzna<br>";
									}
									if(!empty($_POST['sex']) && $selected == k)
									{ 
										echo"<input type=radio name=sex value=k checked=checked>Kobieta";
									}
									else
									{
										echo"<input type=radio name=sex value=k>Kobieta";
									}
									echo
									"</td>
								</tr>
								<tr>
									<td>Nazwisko panieñskie: </td><td><input type=text name=nazwisko_pan value='";if(!empty($_POST['nazwisko_pan'])){print_r($_POST['nazwisko_pan']);} echo"'></td>
								</tr>
								<tr>				
									<td>Kod pocztowy: </td><td><input type=text name=kod_poczt value='";if($val_kpoczt == 1){print_r($_POST['kod_poczt']);} echo"'></td>
								</tr>
								<tr>
									<td>E-mail: </td><td><input type=text name=mail value='";if($val_mail == 1){print_r($_POST['mail']);} echo"'></td>
								</tr>
								<tr>
									<td></td><td><input type=submit value=Wyslij name=formularz></td>
								</tr>
							</table>
						</form>";
				break;
				case 3:
						if(!empty($_SESSION['tablica'][$_SESSION['lform'] -1]))
						{
							echo "Imiê: <b>"; print_r($_SESSION['tablica'][$_SESSION['lform'] -1][0]);
							echo "</b></br>";
							echo "Nazwisko: <b>"; print_r($_SESSION['tablica'][$_SESSION['lform'] -1][1]);
							echo "</b></br>";
							echo "P³eæ: <b>"; print_r($_SESSION['tablica'][$_SESSION['lform'] -1][2]);
							echo "</b></br>";
							echo "Nazwisko panieñskie: <b>"; print_r($_SESSION['tablica'][$_SESSION['lform'] -1][3]);
							echo "</b></br>";
							echo "Kod pocztowy: <b>"; print_r($_SESSION['tablica'][$_SESSION['lform'] -1][4]);
							echo "</b></br>";
							echo "E-mail: <b>"; print_r($_SESSION['tablica'][$_SESSION['lform'] -1][5]);
							echo "</b></br>";							
						}
						else
						{
							echo "Formularz nie zosta³ jeszcze przes³any.";
						}
					
				break;
				case 4:
						if($_GET['szukaj'] == 1)
						{
							header("Location: index.php?id=4&actnum=0&szukaj=0&kryterium=".$_POST['kryterium']."");
						}
						if(isset($_GET['kryterium']))
						{
							echo $kryterium;
							$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
							$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
							
							$nrstr = 0;
							$kryterium = $_GET['kryterium'];
							$newkryterium = str_replace(" ", "+", $kryterium); 
							$kryteria = explode("+",$newkryterium);
							print_r($kryteria);
							$actunum = $_GET['actnum'];
							$min = $actunum;
							$max = $actunum + 10;
							$all = "SELECT * FROM pracownik WHERE nazwisko LIKE '%{$kryteria[0]}%'";
							for($i = 1; $i < count($kryteria); $i++)
							{
								$all.= " OR nazwisko LIKE '%{$kryteria[$i]}%'";
							}
							$all.= " LIMIT $min,$max";
							$allquery = mysql_query($all) or die(mysql_error());
							$maxrows = mysql_num_rows($allquery);
							//$query="SELECT * FROM pracownik WHERE nazwisko LIKE '%{$kryterium}%' LIMIT $min,$max";
							$result=mysql_query($all) or die(mysql_error());
							
							echo "<table border=1 width = 100%>
								<tr>
								<td> Nr </td><td>Imie </td><td>Nazwisko </td><td>Sex </td><td>Nazwisko_pan </td><td>Kod_poczt </td><td>Mail </td>
								</tr>";
							while($row=mysql_fetch_array($result)) 
							{
								$id = $row['id'];
								$imie = $row['imie'];
								$nazw = $row['nazwisko'];
								$plec = $row['plec'];
								$npan = $row['npan'];
								$kpocz = $row['kpoczt'];
								$mail = $row['mail'];
				
								echo "
								<tr>
								<td> $id </td><td>$imie </td><td>$nazw </td><td>$plec </td><td>$npan </td><td>$kpocz </td><td>$mail </td>
								</tr>";
							}
							echo "</table>";
							for($i = 0; $i < $maxrows; $i=$i+10)
							{
								$nrstr++;
								echo "<a href=index.php?id=4&actnum=".$i."&szukaj=0&kryterium=".$newkryterium.">[".$nrstr."]</a>";
							}
							mysql_close($connect);
						}
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						if(!isset($_GET['kryterium']))
						{
							$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
							$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
							
							$nrstr = 0;
							$all = "SELECT * FROM pracownik";
							$allquery = mysql_query($all) or die(mysql_error());
							$maxrows = mysql_num_rows($allquery);
							$actunum = $_GET['actnum'];
							$min = $actunum;
							$max = $actunum + 10;
							$query="SELECT * FROM pracownik LIMIT $min,$max";
							$result=mysql_query($query) or die(mysql_error());
							
							echo "<table border=1 width = 100%>
								<tr>
								<td> Nr </td><td>Imie </td><td>Nazwisko </td><td>Sex </td><td>Nazwisko_pan </td><td>Kod_poczt </td><td>Mail </td>
								</tr>";
							while($row=mysql_fetch_array($result)) 
							{
								$id = $row['id'];
								$imie = $row['imie'];
								$nazw = $row['nazwisko'];
								$plec = $row['plec'];
								$npan = $row['npan'];
								$kpocz = $row['kpoczt'];
								$mail = $row['mail'];
				
								
								echo"<tr>
								<td> $id </td><td>$imie </td><td>$nazw </td><td>$plec </td><td>$npan </td><td>$kpocz </td><td>$mail </td>
								</tr>";
							}
							
							echo "</table>";
							for($i = 0; $i < $maxrows; $i=$i+10)
							{
								$nrstr++;
								echo "<a href=index.php?id=4&actnum=".$i.">[".$nrstr."]</a>";
							}
							mysql_close($connect);
						}
				break;
				case 5:
				
						$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
						$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
							
						$nrstr = 0;
						$all = "SELECT * FROM pracownik";
						$allquery = mysql_query($all) or die(mysql_error());
						$maxrows = mysql_num_rows($allquery);
						$actunum = $_GET['actnum'];
						$min = $actunum;
						$max = $actunum + 10;
						$query="SELECT * FROM pracownik LIMIT $min,$max";
						$result=mysql_query($query) or die(mysql_error());
						echo "<table border=1 width = 100%>
							<tr>
							<td>Akcja</td><td> Nr </td><td>Imie </td><td>Nazwisko </td><td>Sex </td><td>Nazwisko_pan </td><td>Kod_poczt </td><td>Mail </td>
							</tr>";
						while($row=mysql_fetch_array($result)) 
						{
							$id = $row['id'];
							$imie = $row['imie'];
							$nazw = $row['nazwisko'];
							$plec = $row['plec'];
							$npan = $row['npan'];
							$kpocz = $row['kpoczt'];
							$mail = $row['mail'];
				
							echo "
							<tr>
							<td><a href=index.php?id=7&action=edit&uid=".$id.">EDYTUJ</a>
							<td> $id </td><td>$imie </td><td>$nazw </td><td>$plec </td><td>$npan </td><td>$kpocz </td><td>$mail </td>
							</tr>";
						}
						echo "</table>";
						for($i = 0; $i < $maxrows; $i=$i+10)
						{
							$nrstr++;
							echo "<a href=index.php?id=5&actnum=".$i.">[".$nrstr."]</a>";
						}
						mysql_close($connect);
				
				break;
				case 6:
						$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
						$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
							
						$nrstr = 0;
						$all = "SELECT * FROM pracownik";
						$allquery = mysql_query($all) or die(mysql_error());
						$maxrows = mysql_num_rows($allquery);
						$actunum = $_GET['actnum'];
						$min = $actunum;
						$max = $actunum + 10;
						$query="SELECT * FROM pracownik LIMIT $min,$max";
						$result=mysql_query($query) or die(mysql_error());
						echo "<table border=1 width = 100%>
							<tr>
							<td>Akcja</td><td> Nr </td><td>Imie </td><td>Nazwisko </td><td>Sex </td><td>Nazwisko_pan </td><td>Kod_poczt </td><td>Mail </td>
							</tr>";
						while($row=mysql_fetch_array($result)) 
						{
							$id = $row['id'];
							$imie = $row['imie'];
							$nazw = $row['nazwisko'];
							$plec = $row['plec'];
							$npan = $row['npan'];
							$kpocz = $row['kpoczt'];
							$mail = $row['mail'];
				
							echo "
							<tr>
							<td><a href=index.php?id=7&action=delete&uid=".$id.">USUÑ</a>
							<td> $id </td><td>$imie </td><td>$nazw </td><td>$plec </td><td>$npan </td><td>$kpocz </td><td>$mail </td>
							</tr>";
						}
						echo "</table>";
						for($i = 0; $i < $maxrows; $i=$i+10)
						{
							$nrstr++;
							echo "<a href=index.php?id=5&actnum=".$i.">[".$nrstr."]</a>";
						}
						mysql_close($connect);				
				
				
				break;
				case 7:
					if($_GET['action'] == delete)
					{
						echo "Chcesz usunac pracownika z bazy?";
						$id = $_GET['uid'];
						if($_GET['status'] != confirmed)
						{
							echo 
							"<form action=index.php?id=7&action=delete&status=confirmed&uid=".$id." method=post>
							<input type=submit value=Tak name=confirme>
							<input type=submit value=Nie name=confirme>
							</form>";
						}
						if($_POST['confirme'] == Tak)
						{
							$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
							$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
							
							$sql = "DELETE FROM pracownik WHERE id = $id";
							if (mysql_query($sql) == TRUE) {
								echo "Poprawnie usuniêto rekord.";
								header('Location: index.php?id=6&actnum=0');
							} 
							else 
							{
								echo "Nie uda³o siê usun¹æ rekordu.";
								header('Location: index.php?id=6&actnum=0');
							}
							mysql_close($connect);				
						}
						if($_POST['confirme'] == Nie)
						{
								header('Location: index.php?id=6&actnum=0');
								
						}						
					}
					if($_GET['action'] == edit)
					{
						if(!isset($_POST['confirme']))
						{
							$uid = $_GET['uid'];
							$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
							$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
							$query="SELECT * FROM pracownik WHERE id='$uid'";
							$result=mysql_query($query) or die(mysql_error());
						
							while($row=mysql_fetch_array($result)) 
							{
								$id = $row['id'];
								$imie = $row['imie'];
								$nazw = $row['nazwisko'];
								$plec = $row['plec'];
								$npan = $row['npan'];
								$kpocz = $row['kpoczt'];
								$mail = $row['mail'];
							}
							
							echo 
							"<form action=index.php?id=7&action=edit&uid=".$id." method=post>
								<table id=center>
									<tr>				
										<td>Imiê: </td><td><input type=text name=imie value='";print_r($imie); echo"'></td>
									</tr>
									<tr>	
										<td>Nazwisko: </td><td><input type=text name=nazwisko value='";print_r($nazw); echo"'></td>
									</tr>
									<tr>
										<td>P³eæ</td>
										<td>";
										if($plec == m)
										{ 
											echo"<input type=radio name=sex value=m checked=checked>Mê¿czyzna<br>";
										}
										else
										{
											echo"<input type=radio name=sex value=m>Mê¿czyzna<br>";										
										}
										if($plec == k)
										{ 
											echo"<input type=radio name=sex value=k checked=checked>Kobieta";
										}
										else
										{
											echo"<input type=radio name=sex value=k>Kobieta<br>";										
										}
										echo
										"</td>
									</tr>
									<tr>
										<td>Nazwisko panieñskie: </td><td><input type=text name=nazwisko_pan value='";print_r($npan); echo"'></td>
									</tr>
									<tr>				
										<td>Kod pocztowy: </td><td><input type=text name=kod_poczt value='";print_r($kpocz); echo"'></td>
									</tr>
									<tr>
										<td>E-mail: </td><td><input type=text name=mail value='";print_r($mail); echo"'></td>
									</tr>
									<tr>
										<td></td><td><input type=submit value=Zaakceptuj name=confirme> <input type=submit value=Odrzuc name=confirme></td>
									</tr>
								</table>
							</form>";
							
							mysql_close($connect);	
						}						
						////////////////////////////////
						if(isset($_POST['confirme']))
						{
							$id = $_GET['uid'];
							if($_POST['confirme'] == Zaakceptuj)
							{
									$val_imie = (!empty($_POST['imie']));
									$val_nazwisko = (!empty($_POST['nazwisko']));
									$val_plec = (!empty($_POST['sex']));
									$val_kpoczt = (!empty($_POST['kod_poczt']) && preg_match('/^[0-9]{2}-?[0-9]{3}$/Du',$_POST['kod_poczt']));
									$val_mail = (!empty($_POST['mail']) && preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $_POST['mail']));
									
									if($val_imie == 1)
									{
									}
									else
									{
										echo "Nie podano imienia.</br>";
									}
									if($val_nazwisko == 1)
									{
									}
									else
									{
										echo "Nie podano nazwiska.</br>";
									}
									if($val_plec == 1)
									{
										$selected = $_POST['sex'];
									}
									else
									{
										echo "Nie podano p³ci.</br>";
									}
									if($val_kpoczt == 1)
									{
									}
									else
									{
										echo "Niepoprawny kod pocztowy.</br>";
									}
									if($val_mail == 1)
									{
									}
									else
									{
										echo "Niepoprawny adres email.</br>";
									}
									
									if(($val_imie && $val_nazwisko && $val_kpoczt && $val_mail & $val_plec) == 1)
									{				
										$imie = $_POST['imie'];
										$nazw = $_POST['nazwisko'];
										if($_POST['sex'] == m)
										{
											$plec = m;
										}
										if($_POST['sex'] == k)
										{
											$plec = k;
										}
										$npan = $_POST['nazwisko_pan'];
										$kpocz = $_POST['kod_poczt'];
										$mail = $_POST['mail'];
										
										$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
										$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
										
										$sql = "UPDATE pracownik SET imie='$imie',nazwisko='$nazw',plec='$plec',npan='$npan',kpoczt='$kpocz',mail='$mail' WHERE id='$id'";
										
										if(mysql_query($sql) == TRUE)
										{
											echo "Zaktualizowano rekord nr ";
											echo $id;
										}		
										else
										{
											echo "Nie udalo sie zaktualizowac rekordu nr ";
											echo $id;
										}
										header('location:index.php?id=5&actnum=0');
										mysql_close($connect);
									}
							
							}
							if($_POST['confirme'] == Odrzuc)
							{
								header('Location: index.php?id=5&actnum=0');
							}
							if(($val_imie && $val_nazwisko && $val_kpoczt && $val_mail & $val_plec) != 1)
							{							
								echo 
								"<form action=index.php?id=7&action=edit&uid=".$id." method=post>
									<table id=center>
										<tr>				
											<td>Imiê: </td><td><input type=text name=imie value='";if(!empty($_POST['imie'])){print_r($_POST['imie']);} echo"'></td>
										</tr>
										<tr>	
											<td>Nazwisko: </td><td><input type=text name=nazwisko value='";if(!empty($_POST['nazwisko'])){print_r($_POST['nazwisko']);} echo"'></td>
										</tr>
										<tr>
											<td>P³eæ</td>
											<td>";
											if(!empty($_POST['sex']) && $selected == m)
											{ 
												echo"<input type=radio name=sex value=m checked=checked>Mê¿czyzna<br>";
											}
											else
											{
												echo"<input type=radio name=sex value=m>Mê¿czyzna<br>";
											}
											if(!empty($_POST['sex']) && $selected == k)
											{ 
												echo"<input type=radio name=sex value=k checked=checked>Kobieta";
											}
											else
											{
												echo"<input type=radio name=sex value=k>Kobieta";
											}
											echo
											"</td>
										</tr>
										<tr>
											<td>Nazwisko panieñskie: </td><td><input type=text name=nazwisko_pan value='";if(!empty($_POST['nazwisko_pan'])){print_r($_POST['nazwisko_pan']);} echo"'></td>
										</tr>
										<tr>				
											<td>Kod pocztowy: </td><td><input type=text name=kod_poczt value='";if($val_kpoczt == 1){print_r($_POST['kod_poczt']);} echo"'></td>
										</tr>
										<tr>
											<td>E-mail: </td><td><input type=text name=mail value='";if($val_mail == 1){print_r($_POST['mail']);} echo"'></td>
										</tr>
										<tr>
											<td></td><td><input type=submit value=Zaakceptuj name=confirme> <input type=submit value=Odrzuc name=confirme></td>
										</tr>
									</table>
								</form>";
							}
						}
					}
				break;
				case 8:
				if(isset($_POST['logon']))
				{
					$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
					$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
					
					$login_type=$_POST['login'];
					$pass_type=$_POST['haslo'];
					$query = mysql_query("SELECT * FROM uzytkownicy WHERE login='$login_type'"); //wyszukuje w bazie konta o nazwie podanej przez formularz
					$row = mysql_fetch_array($query);
					
					if($row)
					{
						if($pass_type == $row['haslo']) //jesli haslo jest prawidlowe
						{
							$_SESSION['login']=$login_type;							
							$_SESSION['uprawnienia'] = $row['uprawnienia'];
							$_SESSION['imie'] = $row['imie'];
							$_SESSION['nazwisko'] = $row['nazwisko'];	
							mysql_close($connect);
							header("location:index.php?id=1");
						}
						else
						{
							print("Nieprawid³owe has³o.");
							mysql_close($connect);
						//	header("location:index.php?id=8");
						}
					}
					else
					{
						print("Nie ma takiego konta.");
						mysql_close($connect);
						//header("location:index.php?id=8");
					}
				}
				echo 
					"<form action=index.php?id=8 method=post>
						<table id=center>
							<tr>				
								<td>Login: </td><td><input type=text name=login></td>
							</tr>
							<tr>	
								<td>Haslo: </td><td><input type=password name=haslo></td>
							</tr>
							<tr>
								<td></td><td><input type=submit value=Zaloguj name=logon>
							</tr>
						</table>
					</form>";
					
				break;
				case 9:
				if(isset($_POST['register']))
				{

					$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
					$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
					
					$query = "SELECT * FROM uzytkownicy";
					$result = mysql_query($query);
					
					if($result == TRUE)
					{
						//echo "dziala";
					}
					else
					{
						//echo "nie dziala";
					}
					while($row=mysql_fetch_array($result))
					{
						//echo "<br>";
						//echo $row['login'];
						if($_POST['login'] == $row['login'])
						{
							$val_login = 0;
							echo "Login juz istnieje";
							break;
						}
						else
						{
							$val_login = 1;
						}
					}
					if( ($val_login == 1) && (!empty($_POST['login']) == 1) && (strlen($_POST['login']) > 5))
					{
						$val_login = 1;
					}
					else
					{
						$val_login = 0;
					}
					if((strlen($_POST['login']) < 6))
					{
						echo "<br>";
						echo "Login musi miec co najmniej 6 znakow";
					}
					if(empty($_POST['login']))
					{
						echo "<br>";
						echo "Wpisz login";
					}
					if((strlen($_POST['haslo']) < 6))
					{
						echo "<br>";
						echo "Haslo musi miec co najmniej 6 znakow";
					}
					if(empty($_POST['haslo']))
					{
						echo "<br>";
						echo "Wpisz haslo";
					}
					if((strlen($_POST['haslo2']) < 6))
					{
						echo "<br>";
						echo "Haslo2 musi miec co najmniej 6 znakow";
					}
					if(empty($_POST['haslo2']))
					{
						echo "<br>";
						echo "Wpisz haslo2";
					}
					if(empty($_POST['imie']))
					{
						echo "<br>";
						echo "Wpisz imie";
					}
					if(empty($_POST['nazwisko']))
					{
						echo "<br>";
						echo "Wpisz nazwisko";
					}					
						
					$val_imie = (!empty($_POST['imie']));
					$val_nazwisko = (!empty($_POST['nazwisko']));
					if($_POST['haslo'] == $_POST['haslo2'] && (!empty($_POST['haslo']) == 1) && (!empty($_POST['haslo2']) == 1) && (strlen($_POST['haslo']) > 5))
					{
						$val_haslo = 1;
					}
					else
					{
						$val_haslo = 0;
					}
//					echo "<br>";
//					echo $val_login;
//					echo "<br>";
//					echo $val_haslo;
//					echo "<br>";
//					echo $val_imie;	
//					echo "<br>";
//					echo $val_nazwisko;		

					if(($val_login == 1) && ($val_haslo == 1) && ($val_imie == 1) && ($val_nazwisko == 1))
					{
						$login = $_POST['login'];
						$imie = $_POST['imie'];
						$haslo = $_POST['haslo'];
						$nazwisko = $_POST['nazwisko'];
						$sql = "INSERT INTO uzytkownicy (login,haslo,uprawnienia,imie,nazwisko) VALUES ('$login','$haslo','0','$imie','$nazwisko')";
						if (mysql_query($sql) == TRUE) 
						{
							echo "Zarejestrowano uzytkownika</br>";
						} 
						else 
						{
							echo "Error: " . $sql . "<br>" . $connect->error;
						}
					}
					mysql_close($connect);
				}
				if(!isset($_POST['register']) || ($val_login && $val_haslo && $val_imie && $val_nazwisko) == 0)
				{
					echo
						"<form action=index.php?id=9 method=post>
							<table id=center>
								<tr>				
									<td>Login: </td><td><input type=text name=login value='";if($val_login == 1){print_r($_POST['login']);} echo"'></td>
								</tr>
								<tr>	
									<td>Haslo: </td><td><input type=password name=haslo value='";if($val_haslo == 1){print_r($_POST['haslo']);} echo"'></td>
								</tr>
								<tr>	
									<td>Powtorz haslo: </td><td><input type=password name=haslo2 value='";if($val_haslo == 1){print_r($_POST['haslo']);} echo"'></td>
								</tr>
								<tr>				
									<td>Imie: </td><td><input type=text name=imie value='";if($val_imie == 1){print_r($_POST['imie']);} echo"'></td>
								</tr>
								<tr>	
									<td>Nazwisko: </td><td><input type=text name=nazwisko value='";if($val_nazwisko == 1){print_r($_POST['nazwisko']);} echo"'></td>
								</tr>
								<tr>
									<td></td><td><input type=submit value=Zarejestruj name=register>
								</tr>
							</table>
						</form>";	
				}						
				break;
				case 10:
					session_destroy();
					header("location:index.php?id=1");
				break;
				case 11:
	
				break;
				case 12:
					
				break;
				case 13:

				break;
				case 14:
					$rss = getRss("http://www.nyaa.se/?page=rss&term=horriblesubs");
					$feed = readRss($rss);
					saveRss($feed,$rss);
					$dbfeed = getRssDB();
					showRssDB($dbfeed);
				break;
				}
		}
		else
		{
			echo "index";
		}
		?>
	</div>
	<div id = "right">
		<ul class="menu_prawe">
			<li><a href="http://google.com">google.com</a></li>
			<li><a href="http://wp.pl">www.wp.pl</a></li>
			<?php
				if(!isset($_SESSION['login']))
				{
					echo "<li><a href=index.php?id=8>Zaloguj</a></li>";
				}
				else
				{
					echo "<li><a href=index.php?id=10>Wyloguj</a></li>";
				}
			?>
			<li><a href="index.php?id=9">Rejestracja</a></li>
			
			<?php
				if(isset($_SESSION['login']))
				{
					echo"
					
					";
					echo
						"<form action=index.php?id=4&actnum=0&szukaj=1 method=post>
						<input type=text name=kryterium>
						<input type=submit value=Wyslij name=wyszukiwanie>
						</form>";
				}
			?>
		</ul>
	</div>
	<div id = "bottom">
		<?php
			echo "Liczba zapisanych pracowników w sesji: ";
			print_r($_SESSION['lform']);
			echo "</br>";
		?>
	</div>
</div>
</body>
</html>