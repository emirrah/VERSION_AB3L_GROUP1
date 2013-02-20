<!--
Page Description:
	This page allows the ordinary user to view current virtual tray food items.
	This displays the food code, food description, and price of each food items.
	Along with these are the links that enables the admin to remove a specific food item.
-->

<script>
	/* This function asks the admin once whether s/he really wants to remove the sepecific food item from the menu. */
	function confirmRemove(remItem) {
		if (confirm("Are you sure you want to remove this item?")) {		/* if admin chooses 'OK', delete successful. Otherwise, no change.*/
			document.location = remItem;
			}
		}
</script>


<?php require_once ("header.php");			 // acts like include(); displays the header of the html ?>
	
	<a href="user.php" > Return to Main Page</a>
	<article id="greet">
		<?php
			if (isset ($_SESSION['username'])) {							// user is logged in
				$user = $_SESSION['username'];								// store username to variable $username
				echo "<h3 style=\"text-align:right;\"> Hello, {$user}! ";	// greet user
				echo " | <a href=\"logout.php\"> Logout </a></h3>";			// displays the logout link
				}
				
			else {															// user is not logged in
				header ("Location: index.php");								// redirect to login page
				}
		?>
	</article>
	
	<article id="content">
		<?php
			if($_SESSION['food'] == 0){															// check if the cart is empty or not
				echo " <center><h1 id=\"cart\"> <i> Food tray is currently empty. </i> </h1></center><br /><br />";	// notify the user that cart is empty
				$_SESSION['foodcount'] = 0;
				$_SESSION['food'] = 0;
				$_SESSION['tray'] = array();
				}
			else{
				echo "<center><h1 id=\"cart\"> <i> List of Food Items </i></h1></center>";	// show the list of items of the tray
				echo "<center><table id=\"cart\">";											// create a table for displaying items
				echo "<tr><td id=\"item\"> Food Code </td><td id=\"item\"> Food Description</td><td id=\"item\"> Price </td><td id=\"item\"> Option </td></tr>";	// create a table row with columns namely "Food Code", "Food Description", "Price", "Option"
				$total = 0;																	// resets the value of total price
				
				$codes = "";
				$init = $_SESSION['tray'][0][0];
				for($i = 0; $i <= $_SESSION['foodcount']; $i += 1){							// loop that prints the cart contents
					if(isset($_SESSION['tray'][$i])){										//	      if it is not empty
						echo "<tr>";
						echo "<td id=\"item\">{$_SESSION['tray'][$i][0]}</td>";				// displays food code
						echo "<td id=\"item\">{$_SESSION['tray'][$i][1]}</td>";				// displays food code
						echo "<td id=\"item\">{$_SESSION['tray'][$i][2]}</td>";				// isplays item price
						$n = urlencode($_SESSION['tray'][$i][0]);							// a temporary variable to be used later
						echo "<td id=\"item\"> <a id=\"cart\" href=\"javascript:confirmRemove('removeItem.php?item={$n}') \"> Remove Item </a></td>"; // remove item
						echo "</tr>";														// closes a row
						$total += $_SESSION['tray'][$i][2];									// increment $total or the sum of the items
						$init = $_SESSION['tray'][$i++][0] . " ";								// store to $codes all foodcodes	
						$codes = $codes . $init;
						}
						//echo $codes
						settype ($codes, "string");
					}
					
				echo "<tr><td id=\"item\"></td><td id=\"item\">Total Price</td><td id=\"item\">{$total}</td><tr>";	// displays the total cost
				echo "<tr><td> </td> <td><br/><a href=\"process_queue_orders.php?uname={$_SESSION['username']}&total={$total}&order={$codes}\" > Submit Order Now</a></td></tr>";
				echo "</table></center>";				
				//$_SESSION["{$_SESSION['username']}"]['codes'] = $codes;
				// print_r ($codes);
				}
		?>
		<br />
		<center><a href="user.php" > Return to Main Page</a> </center>
	</article>



<?php require_once ("footer.php");	// acts like include(); displays the footer of the html ?>
