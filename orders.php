<!--
Page Description:
	This page allows the user to view his/her ordered items.
	This displays the order number, customer, food codes of food items and total price.
	Along with these are the links that enables the admin remove finished ordered item.
-->
<?php require_once ("header.php");			 // acts like include(); displays the header of the html ?>
	
	<article id="greet">
		<?php
			if (isset ($_SESSION['username'])) {							// user is logged in
				$user = $_SESSION['username'];								// store username to variable $username
				echo "<h3 style=\"text-align:right;\"> Hello, <a href=\"viewAccount.php\">$user</a>! ";	// greet user
				echo " | <a href=\"logout.php\"> Logout </a></h3>";			// displays the logout link
				}
				
			else {															// user is not logged in
				header ("Location: index.php");								// redirect to login page
				}
		?>
	</article>
	<article id="content">
		<center>
		<?php
			require_once ("connect.php");		//connect to database
			
			$count = $_SESSION['foodcount'];
			$i = 0;
			$str = "";
			
			if (isset ($_GET['flag'])){			// $_GET['set'] acts like the flag; this line means that flag 'set' is passed
				$error = $_GET['flag'];			// flag 'set' is stored in $error variable
				if ($error == 5) {				// if $error == 5 the display an error message below the Food Code input field
					echo "<h3 style='color:rgb(0,255,0);font-size:20px;'> Your order is successfully added! </h3>";
			
					$x = $_SESSION['payment'];
					$uname = $_GET['uname'];
					$total = $_GET['total'];
					$orderlist = $_GET['orderlist'];
					
					echo "<table>";
					echo "<tr><td> Customer:</td> <td>{$uname} </td></tr>";		//username
					echo "<tr><td>Total Price: </td> <td>{$total} </td> </tr>";	//total price
					echo "<tr><td>Payment: </td><td>{$x}</td> </tr>";			//payment
					echo "<tr><td>Change: </td><td>";
					echo $x-$total . "</td> </tr>";								//change
					echo "</table><br/>";
					echo "<table> <tr> <td><b>Food Code</b></td> <td><b><center>Food Description</center></b></td> </tr>";
					
					
					//reward points
					$old_rp = mysql_query("select rewardpoints from users where username=\"{$_SESSION['username']}\" ");
					$old_rps = mysql_fetch_array ($old_rp);
									
					$new_rp = $total/50;
					settype($new_rp, "integer");
					$new_rp = $new_rp + $old_rps[0];
					mysql_query("update users set rewardpoints=$new_rp where username=\"$uname\"") or die ("Unable to insert items to users.");		

					$str = strtok ($orderlist, " ");
						
					while ($str != false) {
						echo "<tr>";
						$result = mysql_query ("select * from menu where foodcode=\"{$str}\"; ") or die ("Unable to retrieve items.");
						while ($item = mysql_fetch_array ($result) ) {
							echo "<td><center> {$item[0]}</center></td>";	//foodcode
							echo "<td> {$item[1]}</td>";					//food description
							}
						$str = strtok (" ");
					echo "</tr>";
						}
					}
					
				elseif ($error == 6) {				// if $error == 5 the display an error message below the Food Code input field
					echo "<h3 style='color:rgb(0,255,0);'> Your order is successfully added! </h3>";
			
					$x = $_SESSION['payment'];
					$uname = $_GET['uname'];
					$total = $_GET['total'];
					$orderlist = $_GET['orderlist'];
					
					echo "<table>";
					echo "<tr><td>Customer:</td> <td>{$uname} </td></tr>";
					echo "<tr><td>Total Price: </td> <td>{$total} </td> </tr>";
					echo "<tr><td>Payment: </td><td>{$x}</td> </tr>";
					echo "<tr><td>Change: </td><td>";
					echo $x-$total . "</td> </tr>";
					echo "</table><br/>";
					echo "<table> <tr> <td><b>Food Code</b></td> <td><b><center>Food Description</center></b></td> </tr>";

					$str = strtok ($orderlist, " ");
						
					while ($str != false) {
						echo "<tr>";
						$result = mysql_query ("select * from menu where foodcode=\"{$str}\"; ") or die ("Unable to retrieve items.");
						while ($item = mysql_fetch_array ($result) ) {
							echo "<td><center> {$item[0]}</center></td>";
							echo "<td> {$item[1]}</td>";
							}
						$str = strtok (" ");
					echo "</tr>";
						}
					}
					
				else{
					header ("Location: user.php");
				}
			}
			echo "</table>";
			
		?>
		</center>
		<br />
		<center><a href="user.php" > Return to Main Page</a> </center>
	</article>

<?php require_once ("footer.php");	// acts like include(); displays the footer of the html ?>