<?php
	function connect()
	{
		$connect = mysql_connect('localhost', '', '') or die("Error: Brak po��czenia z serwerem MySQL");
		$select = mysql_select_db('') or die('Error: B��d wyboru bazy danych');
		
		return $connect;
	}
	function disconnect($connect)
	{
		mysql_close($connect);
	}
?>
	