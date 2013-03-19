<!--
	This page displays the user to view the information.
-->

<?php require_once ("header.php");			 // acts like include(); displays the header of the html ?>
	<article id="greet">
		<?php
			if (isset ($_SESSION['username'])) {
				if ($_SESSION['username'] == "admin"){				
				$user = $_SESSION['username'];
				echo "<h3 style=\"text-align:right;\"> Hello, {$user}! ";
				echo " | <a href=\"logout.php\"> Logout </a></h3>";
				}
			}
			else {
				header ("Location: index.php");
				}
		?>


<?php
	if (isset ($_GET['set']) ){
		if ($_GET['set'] == 8) {
			echo "<center> <h2> Queueing successful!</h2> </center><br/>";
			}
		}
		
	if (isset ($_SESSION['username'])) {										// checks if user is logged in
		$uname = $_GET['uname'];
		$users = mysql_query ("select * from users where username='$uname'");	// retrieve rows of the table 'menu'
		
		while ($item = mysql_fetch_array ($users)) {							// mysql_fetch_array() gets a line from $names then assign it to $item as array
				echo "<tr>";
				echo "<td>Username: {$item[0]}</td><br/>";
				echo "<td>E-mail Add: {$item[2]}</td><br/>";
				echo "<td>First Name: {$item[3]}</td><br/>";
				echo "<td>Last Name: {$item[4]}</td><br/>";
				echo "<td>Birthday: {$item[5]}</td><br/>";
				echo "<td>Address: {$item[6]}</td><br/>";
				echo "<td>Contact Number: {$item[8]}</td><br/>";
				echo "<td>Reward Point(s): {$item[7]}</td><br/><br/><br/>";
				echo "</tr>";
			}
		mysql_close ($conn);						// closes connection opened
		}
?>