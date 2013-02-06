<?php
	session_start();
	
	require_once ("connect.php");
	
?>
<!DOCTYPE html>


<html>
	<head>
		<title> Online Food Ordering System </title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="script.js" > </script>
	</head>
	
	<body>
		<section>
			<header id="banner">
				<center><h1> Online Food Ordering System </h1></center>
				<!--img src="images/banner.jpg"-->
			</header>
		<article id="greet">
		<?php
			if (isset ($_SESSION['username'])) {
				$user = $_SESSION['username'];
				echo "<h3 style=\"text-align:right;\"> Hello, {$user}! ";
				echo "| <a href=\"logout.php\"> Logout </a></h3>";
				}
			else {
				header ("Location: index.php");
				}
		?>
		</article>
		<br/><br/>
		
		<article id="content">
			<a href="viewCurrentMenuItems.php" > View Current Menu Items </a> <br/>
			<a href="addFoodItems.php" > Add Food Item(s) in Menu </a>
		</article>

