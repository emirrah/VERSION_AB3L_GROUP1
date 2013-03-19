<!--
	This is just a portion of the html page that opens the page for the admin.
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
		<article id="greet">
		<?php
			//displays the user if logged-in if not, displays the main page
			if (isset ($_SESSION['username'])) {							// checks if admin has logged in
				$user = $_SESSION['username'];								// store login username to a variable
				echo "<h3 style=\"text-align:right;\"> Hello, {$user}! ";	// displays the login username
				echo "| <a href=\"logout.php\"> Logout </a></h3>";			// displays the logout link
				}
			else {
				header ("Location: index.php");								// redirect to login page if username is not set or if admin is not logged in
				}
		?>
		
		</article>
		<br/><br/>
		
		<article id="content">
			<!-- links for navigation-->
			<div id="navi">
				<ul style="width: 100%;">
					<li style="margin-bottom: 30px;"><a href="viewCurrentMenuItems.php" > View Current Menu Items </a></li>	<!-- link to view the menu items -->
					<li style="margin-bottom: 30px;"><a href="addFoodItems.php" > Add Food Item(s) in Menu </a><li>			<!-- link to add menu items -->
					<li><a href="viewOrderList.php" > View Orders' List </a><li>						<!-- link to view the order list -->
				</ul>
			</div>