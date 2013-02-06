<?php require_once ("header.php"); ?>
	
	<article id="greet">
		<?php
			if (isset ($_SESSION['username'])) {
				$user = $_SESSION['username'];
				echo "<h3 style=\"text-align:right;\"> Hello, {$user}! ";
				echo " | <a href=\"logout.php\"> Logout </a></h3>";
				}
			else {
				header ("Location: index.php");
				}
		?>
	</article>
	
	<article id="content">
		<?php require_once ("view.php");?>
		
		<center> <a href="viewtray.php" > View Tray</a> | <a href="user.php" > Return to Main Page</a> </center>
	</article>
	
	
<?php require_once ("footer.php"); ?>