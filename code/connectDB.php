<?php
	function connect()
	{
		$connect = mysql_connect('localhost', 'u884401057_aparu', 'tieryk9776') or die("Error: Brak po³¹czenia z serwerem MySQL");
		$select = mysql_select_db('u884401057_silab') or die('Error: B³¹d wyboru bazy danych');
		
		return $connect;
	}
	function disconnect($connect)
	{
		mysql_close($connect);
	}
?>
	