<?php

	$host = "10.40.10.100";
	$user = "xxx";
	$password = "xx";
	$db = "gpoi_work";
	
	$conn = new mysqli($host, $user, $password, $db) or die("Errore connessione: ".mysqli_connect_errno()); 
	 
	/*$host = "localhost";
	$user = "root";
	$password = "";
	$db = "gpoi_work";
	
	$conn = new mysqli($host, $user, $password, $db) or die("Errore connessione: ".mysqli_connect_errno());*/

?>