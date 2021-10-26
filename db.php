<?php
	$servername = "localhost";
	$dbuser = "root";
	$dbpassw = null;
	$dbname = "restaurant_guide";
	
	//Create connection
	$conn = mysqli_connect($servername, $dbuser, $dbpassw, $dbname);
	//Check connection
	if(!$conn)
	{
		die("Connection error: " . $conn->connection_error);
	}
	
?>