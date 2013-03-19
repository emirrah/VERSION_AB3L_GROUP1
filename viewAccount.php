<!--
	This file displays the account and information of the user.
-->

<?php require_once ("header.php");			 // acts like include(); displays the header of the html ?>
	<article id="greet">
		<?php
			//checks if the logged in, if not redirect to main page
			if (isset ($_SESSION['username'])) {
				$user = $_SESSION['username'];
				echo "<h3 style=\"text-align:right;\"> Hello, <a href=\"viewAccount.php\">$user</a>! ";
				echo " | <a href=\"logout.php\"> Logout </a></h3>";
				}
			else {
				header ("Location: index.php");
				}
		?>
	</article>


	<article id="content">
		<h2 style='color:#08c; font-size:30px;'><center> User Profile </center></h2>
		<?php
			if (isset ($_GET['set']) ){
				if ($_GET['set'] == 8) {
					echo "<center> <h2> Queueing successful!</h2> </center>";
					}
				}
				
			if (isset ($_SESSION['username'])) {							// checks if user is logged in
				$users = mysql_query ("select * from users where username='$user'");		// retrieve rows of the table 'menu'
				
				echo "<center><table style='margin-top:100px'>";
				while ($item = mysql_fetch_array ($users)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
						echo "<tr><td>Username:</td><td> {$item[0]}</td></tr>";
						echo "<tr><td>E-mail Add:</td><td> {$item[2]}</td></tr>";
						echo "<tr><td>First Name: </td><td>{$item[3]}</td></tr>";
						echo "<tr><td>Last Name: </td><td>{$item[4]}</td></tr>";
						echo "<tr><td>Birthday: </td><td>{$item[5]}</td></tr>";
						echo "<tr><td>Address: </td><td>{$item[6]}</td></tr>";
						echo "<tr><td>Contact Number:</td><td> {$item[8]}</td></tr>";
						echo "<tr><td>Reward Point(s): </td><td>{$item[7]}</td></tr>";						
					}
				echo "</table></center>";
				mysql_close ($conn);									// closes connection opened
				}
				
?>
	</article>

	<!--footer and link to user page-->
	<div style="clear:both;">
		<br/><br/>
		<center><a href="user.php" > Return to Main Page</a> </center>
		<?php require_once ("footer.php"); ?>
	</div>