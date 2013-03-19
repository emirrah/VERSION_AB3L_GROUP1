<!--
	This is just a portion of the html page that opens the page.
	This is responsible for opening a connection and displaying the banner(image), if available.
-->

<?php
	session_start();				// opens a session
	require_once ("connect.php");	// creates a connection using 'connect.php'
?>


<!DOCTYPE html>


<html>
	<head>
		<title> Online Food Ordering System </title>
		<meta charset="utf-8" />
		
		<!-- stylesheets and scripts needed for the system-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		
		<script type="text/javascript" src="js/jquery-1.9.1.js" > </script>
		<script type="text/javascript" src="js/bootstrap.js" > </script>
		<script type="text/javascript" src="js/script.js" > </script>
	</head>
	
	<body>
		<section>
			<header id="banner2">
				<!--displays the banner image-->
				<img id='banner2' src="images/bg/chicken3.jpg" />
			</header>