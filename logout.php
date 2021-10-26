<?php
	session_start();
	
	if(isset($_SESSION['username']))
	{
		//session_unset($_SESSION['username']);
		session_destroy();
		header("Location: http://localhost/WebDev2/home.php?logout=success");
		exit();
	}
	else
	{
		header("Location: http://localhost/WebDev2/login.php");
		exit();
	}
?>