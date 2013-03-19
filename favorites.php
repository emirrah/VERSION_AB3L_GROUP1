<?php
	require_once ("header.php");
?>

<script>
	/* This function asks the admin once whether s/he really wants to remove the sepecific food item from the menu. */
	function confirmRemove(remItem) {
		if (confirm("Are you sure you want to remove '" + remItem.substring(27)  + "' from favorites?")) {		/* if admin chooses 'OK', delete successful. Otherwise, no change.*/
			document.location = remItem;
			}
		}
</script>

	<article id="greet">
		<?php
			//checks the the user if logged-in, if not redirect to main page
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
	
	<!-- displays all the food to create food combinations-->
	<article id="content" style="margin-top:60px;">
		<center> <h2> Welcome to Favorites Page. <br/> You may create food combination(s) for faster ordering. <br/ ><a href="about.php">Learn More</a> </h2> </center>
		<div id="favor">
			<center> <table>
			
			<?php
				if (isset ($_SESSION['username'])) {						// checks if user is logged in
					$menu = mysql_query ("select * from menu;");			// retrieve rows of the table 'menu'
					
					$i = 0;
					
					while ($item = mysql_fetch_array ($menu)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
						if (($i-3) % 4 === 1) {
							echo "<tr>";
							echo "<td class='FavImg'> <a href=\"addtofavorites.php?flag=1&item={$item[0]}\"><img class=\"menuItems\" src=\"images/{$item[4]}\"> </a><br/>";
							echo " <a href=\"addtofavorites.php?flag=1&item={$item[0]}\"> Add</a></td>";	// Link that Adds the specific food items in the virtual tray
							//item[0] is the foodcode and item[4] is the filename of the picture in the database
							$i += 1;
							}
						else {							
							echo "<td class='FavImg'> <a href=\"addtofavorites.php?flag=1&item={$item[0]}\"><img class=\"menuItems\" src=\"images/{$item[4]}\"> </a><br/>";
							echo " <a href=\"addtofavorites.php?flag=1&item={$item[0]}\"> Add</a></td>";	// Link that Adds the specific food items in the virtual tray
							//item[0] is the foodcode and item[4] is the filename of the picture in the database
							$i += 1;
							}
						if (($i-3) % 4 === 4) {
							echo "</tr>";
							$i += 1;
							}
						}
					mysql_close ($conn);									// closes connection opened
					}
				else {														// user is not logged in
					header ("Location: index.php");							// redirect to login page
					}
					
			?>
			</table></center>
		</div>
		
		<div id="fav">
			<center> <h3> Favorites </h3> <table>
			<?php
				if (isset ($_GET['error']) && $_GET['error'] = 1) {
					echo "<h4 style='color:red'> Successfully added to favorites! </h4>";
					}
					
				else {
					//displays the item to be added to favorite food of the user
					$codes = array();
					$delimeter = " ";
					$orderlist = "";
					$total = 0;
					
					
					if ($_SESSION['favcount'] == 0) {
						$_SESSION['fav'] = 0;
						$_SESSION['favcount'] = 0;
						$_SESSION['favorites'] = array();
						}
					
					for($i = 0; $i <= $_SESSION['favcount']; $i += 1){								// loop that prints the cart contents
						if(isset($_SESSION['favorites'][$i])){										// if it is not empty
							echo "<tr>";
							echo "<td id=\"item\">{$_SESSION['favorites'][$i][0]}</td>";			// displays food code
							$n = urlencode($_SESSION['favorites'][$i][0]);							// a temporary variable to be used later
							echo "<td id=\"item\"> <a id=\"cart\" href=\"javascript:confirmRemove('removeItem.php?flag=2&item={$n}') \"> Remove</a></td>"; // remove item
							echo "</tr>";															// closes a row
							$total += $_SESSION['favorites'][$i][2];								// increment $total or the sum of the items
							$codes[$i] = $_SESSION['favorites'][$i][0];								// store to $codes all foodcodes
							$orderlist = $orderlist.$n.$delimeter;
							}
						}
							
						if ($total > 0) {
							echo "<tr><td>Price:</td><td>{$total}<br /></td></tr>";
							echo "<tr><td></td><td><br /><a href='addtofavorites.php?flag=2&price={$total}&orderlist={$orderlist}'><button>Add to Favorites</button> </a></td></tr>";
							}
					}
			?>
			
			</table><br/><a href="viewFavorites.php" style='color:#08c; font-size:20px;'>View Favorites</a></center>
		</div>
		
		
	</article>
	<div style="clear:both;">
		<br/><br/>
		<center><a href="user.php" > Return to Main Page</a> </center>
		<?php require_once ("footer.php"); ?>
	</div>