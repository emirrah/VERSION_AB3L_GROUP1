<?php require_once ("header.php"); ?>
	
	<a href="user.php" > Return to Main Page</a>
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
		<center><a href="user.php" > Return to Main Page</a> </center>
	</article>



<?php require_once ("footer.php"); ?>