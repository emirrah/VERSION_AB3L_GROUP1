<!--
Page Description:
	This page allows the ordinary user to view current virtual tray food items.
	This displays the food code, food description, and price of each food items.
	Along with these are the links that enables the admin to remove a specific food item.
-->

<script>
	/* This function asks the admin once whether s/he really wants to remove the sepecific food item from the menu. */
	function confirmRemove(remItem) {
		if (confirm("Are you sure you want to remove '" + remItem.substring(27)  + "' from the menu?")) {		/* if admin chooses 'OK', delete successful. Otherwise, no change.*/
			document.location = remItem;
		}
	}
	function computeValue() {
		var a=parseInt(document.getElementById('php20').value);
		var b=parseInt(document.getElementById('php50').value);
		var c=parseInt(document.getElementById('php100').value);
		var d=parseInt(document.getElementById('php200').value);
		var e=parseInt(document.getElementById('php500').value);
		var f=parseInt(document.getElementById('php1000').value);
		var g = (a*20)+(b*50)+(c*100)+(d*200)+(e*500)+(f*1000);		// computed total
		var tab2 = document.getElementById("totalpayment");
		var tab3 = document.getElementById("totalamount");
		tab2.value = g;
		tab3.value = g;		
	}
</script>


<?php require_once ("header.php");			 // acts like include(); displays the header of the html ?>
	
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
		<div style="width: 698px; float: left;">
			<?php
				if($_SESSION['food'] == 0){																	// check if the cart is empty or not
					echo " <center><h1 id=\"cart\"> <i> Food tray is currently empty. </i> </h1></center>";	// notify the user that cart is empty
					$_SESSION['foodcount'] = 0;
					$_SESSION['food'] = 0;
					$_SESSION['tray'] = array();
					}
				else{
					if(isset ($_GET['set']) ){
						$error = $_GET['set'];			// flag 'set' is stored in $error variable
						if ($error == 5) {				// if $error == 5 the display an error message
							echo "<center><h3 style='color:rgb(255,0,0);'> Insufficient Amount!<br /> Payment must be greater than or equal to total price.</h3><center>";
							}
						}
					echo "<center><h1 id=\"cart\"> <i> List of Food Items </i></h1></center>";	// show the list of items of the tray
					echo "<center><table id=\"cart\">";											// create a table for displaying items
					echo "<tr><td id=\"item\"> Food Code </td><td id=\"item\"> Food Description</td><td id=\"item\"> Price </td><td id=\"item\"> Option </td></tr>";	// create a table row with columns namely "Food Code", "Food Description", "Price", "Option"
					$total = 0;																	// resets the value of total price
					$codes = array();
					$delimeter=" ";
					$orderlist="";
					$amount = 0;
					
					for($i = 0; $i <= $_SESSION['foodcount']; $i += 1){							// loop that prints the cart contents
						if(isset($_SESSION['tray'][$i])){										// if it is not empty
							echo "<tr>";
							echo "<td id=\"item\">{$_SESSION['tray'][$i][0]}</td>";				// displays food code
							echo "<td id=\"item\">{$_SESSION['tray'][$i][1]}</td>";				// displays food description
							echo "<td id=\"item\">{$_SESSION['tray'][$i][2]}</td>";				// displays item price
							$n = urlencode($_SESSION['tray'][$i][0]);							// a temporary variable to be used later
							echo "<td id=\"item\"> <a id=\"cart\" href=\"javascript:confirmRemove('removeItem.php?flag=1&item={$n}') \"> Remove Item </a></td>"; // remove item
							echo "</tr>";														// closes a row
							$total += $_SESSION['tray'][$i][2];									// increment $total or the sum of the items
							$codes[$i] = $_SESSION['tray'][$i][0];								// store to $codes all foodcodes
							$orderlist = $orderlist.$n.$delimeter;
							}
						}
					$_SESSION['total'] = $total;
					$_SESSION['orderlist'] = $orderlist;
					
					
					echo "<tr><td id=\"item\"></td><td id=\"item\">Total Price</td><td id=\"item\">{$total}</td><tr>";	// displays the total cost
					echo "<tr><br /><td> Bills</td> <td>Number of Bills</td></tr>";
					echo "<tr><br /><td> 20 </td><td> <input type='number' id='php20' min='0' max='20' value='0' onchange='computeValue()' /> </td> <td></td></tr>";
					echo "<tr><br /><td> 50 </td><td> <input type='number' id='php50' min='0' max='20' value='0' onchange='computeValue()' /> </td> <td></td></tr>";
					echo "<tr><br /><td> 100 </td><td> <input type='number' id='php100' min='0' max='20' value='0' onchange='computeValue()' /></td> <td> </td></tr>";
					echo "<tr><br /><td> 200 </td><td> <input type='number' id='php200' min='0' max='20' value='0' onchange='computeValue()' /> </td> <td></td></tr>";
					echo "<tr><br /><td> 500 </td><td> <input type='number' id='php500' min='0' max='20' value='0' onchange='computeValue()' /></td> <td> </td></tr>";
					echo "<tr><br /><td> 1000 </td><td> <input type='number' id='php1000' min='0' max='20' value='0' onchange='computeValue()' /></td> <td> </td></tr>";
					echo "<tr><br /><td>  </td><td><form method='get' action='process_queue_orders.php'>";
					echo "<input type='hidden' name='payment' id='totalpayment' value='0'  > </input></td> <td> </td></tr>";
					echo "<tr><td>Total</td><td>";
					echo "<input type='text' name='amount' id='totalamount' value='0' disabled='disabled' > </input></td> <td> </td></tr>";
					echo "<tr><td> </td> <td><br/><input type='submit' value='Submit Order Now' /></form></td></tr>";
					echo "</table></center>";
					$_SESSION["{$_SESSION['username']}"]['codes'] = $codes;
					// print_r ($codes);
				}
					
			?>
			<br />
			<center><a href="user.php" > Return to Main Page</a> </center>
		</div>
		
		<div style="width: 498px; float: right;">
		
		</div>		
	</article>

<?php require_once ("footer.php");	// acts like include(); displays the footer of the html ?>