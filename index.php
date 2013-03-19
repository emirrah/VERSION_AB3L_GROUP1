<!--
Page Description:
	This page allows the user/admin to login to his/her account, sign-up and view the available menu items.
	The admin has his/her own set of username and password that is not stored in the users table of unoDB.
-->

<?php require_once ("header.php");												// acts like include(); displays the header of the html 
	if (isset ($_SESSION['username'])) {										// check if user is logged in
		if ($_SESSION['username'] == "admin") header ("Location: admin.php");	// if "admin", redirect to admin page
		else header ("Location: user.php");										// if typical user, redirect to user page
		} 
?>
			<article id="login">
			<br />
			<br />
			<br />
				<center><table>
					<!--sign-in form for log-in-->
					<form action="process_login.php" method="post">
						<tr> <?php 
								if (isset ($_GET['set'])) {		// $_GET['set'] acts like a flag
									if ($_GET['set'] == 3)		// if flag 'set' == 3, prints a successful message after creating an account
										echo "<h1 style='color:red;'> Congratulations! Create account is successful! </h1>";
									}
							?></tr>
						<tr> <h1 style='color:#08c;'> Welcome to Online Food Ordering System! </h1> </tr>
						<tr>
							<td id="add"  style='color:#08c;'> Username </td>
							<td id="add"> <input type="text" name="username" placeholder="required" required/></td>
						</tr>
						<tr>
							<td id="add"  style='color:#08c;'> Password </td>
							<td id="add"> <input type="password" name="pw" placeholder="required" required/></td>
						</tr>
						<tr>
							<?php 
								if (isset ($_GET['set'])) {		// $_GET['set'] acts like a flag
									$error = $_GET['set'];		
									if ($error == 1) {			// if error == 1, prints an error message
										echo "<td></td><td style='color:red; font-size:12px;'> * Invalid username or password! </td>";
										}
									}
							?>
						</tr>
						<tr>
							<td id="add"> </td>
							<td id="add"><input type="submit" value="login" /> </td>
						</tr>
						<tr>
							<td id="add"> </td>
							<td id="add"><br/><br/>Do not have an account?<a href="signup.php" ><br/>Create Account </a></td>
						</tr>
					</form>
				</table>
				</center>
			</article>
			<br/><br/><br/>
			<article id="content2">
				<?php require_once ("carousel.php"); //displays images of foods?>
				<!--displays the food items available for the day-->
				<center><h2 style='color:#08c; font-size:25px;'> Menu of the Day! </h2><table>
				<?php
					$menu = mysql_query ("select * from menu;");		// retrieve menu items from table 'menu'
					
					echo "<tr> <td style='color:#08c;'><b>Food Code</b> </td><td style='color:#08c;'><b><center>Food Name</center> </b></td><td style='color:#08c;'><b>Price </b></td></tr>";
					while ($item = mysql_fetch_array ($menu)) {			// mysql_fetch_array() gets a line from $menu then assign it to $item as array
						if ($item[3] == 1) {							// checks if the food is available
							echo "<tr>";
							echo "<td> <center>{$item[0]}</center></td>";	// food code
							echo "<td> {$item[1]}</td>";					// food description
							echo "<td> <center>{$item[2]}</center></td>";	// price
							echo "</tr>";
							}
						}
					mysql_close ($conn);			// closes the connection opened
				?>
				</table></center>
				<br/><br/><br/>
			</article>
			<br/>
			<br/>

<?php require_once ("footer.php");	// acts like include(); displays the footer of the html ?>