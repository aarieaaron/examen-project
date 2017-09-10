<?php
$database_select = $_SERVER["HTTP_HOST"];
switch ($database_select)
	{
		case "localhost":
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "examen";
		break;
	}
$connection = mysqli_connect($servername, $username, $password, $dbname) or die("Fout geen server-verbinding".mysqli_error($connection));
$connection2 = mysqli_connect($servername, $username, $password, $dbname) or die("Fout geen server-verbinding".mysqli_error($connection));
$connection3 = mysqli_connect($servername, $username, $password, $dbname) or die("Fout geen server-verbinding".mysqli_error($connection));
?>
