<!--
Page Description:
	This page is the ordinary user's page.
	This is where ordering can be done.	
-->

<script>
	/* This function asks the user once whether s/he really wants to remove the sepecific food item from the tray. */
	function confirmRemove(remItem) {
		if (confirm("Are you sure you want to remove '" + remItem.substring(37)  + "' from the menu?")) {		/* if admin chooses 'OK', delete successful. Otherwise, no change.*/
			document.location = remItem;
		}
	}
	/*This function computes for the total amount adding the values of the bills/coins*/
	function computeValue() {
		var a=parseInt(document.getElementById('php20').value);
		var b=parseInt(document.getElementById('php50').value);
		var c=parseInt(document.getElementById('php100').value);
		var d=parseInt(document.getElementById('php200').value);
		var e=parseInt(document.getElementById('php500').value);
		var f=parseInt(document.getElementById('php1000').value);
		var j=parseInt(document.getElementById('php5').value);
		var k=parseInt(document.getElementById('php10').value);
		
		var g = (j*5)+(k*10)+(a*20)+(b*50)+(c*100)+(d*200)+(e*500)+(f*1000);		// computed total amount
		var tab2 = document.getElementById("totalpayment");
		var tab3 = document.getElementById("totalamount");
		tab2.value = g;
		tab3.value = g;		
	}
</script>

<?php require_once ("header.php");			 // acts like include(); displays the header of the html ?>
	<article id="greet">
		<?php
			if (isset ($_SESSION['username'])) {	//checks if logged in
				$user = $_SESSION['username'];
				echo "<h3 style=\"text-align:right;\"> Hello, <a href=\"viewAccount.php\">$user</a>! ";
				echo " | <a href=\"logout.php\"> Logout </a></h3>";
				
				}
			else {	//redirect to main page if logged out
				header ("Location: index.php");
				}
		?>
	</article>
	
	
	<article id="content">		
		<h2 style='text-align:right; margin-right:30px;'> <a href='favorites.php' > Favorites</a> | <a href='about.php'>About</a></h2>
		<h3 style='text-align:right; margin-right:30px;'> Current Reward Point(s): <?php echo $_SESSION['new_rw'] ?></h3>
		<h2 style='text-align:left; margin-left: 260px; color:#08c; font-size:30px;'> Menu of the Day! </h2>
		<div id="userMenu">
			<?php				
				if (isset ($_GET['set']) && $_GET['set'] == 8){
					echo "<center> <h3> Queueing successful!</h3> </center><br/>";
					}
				if ($_SESSION['food'] == 0) {
					$rp = mysql_query ("select rewardpoints from users where username=\"{$_SESSION['username']}\" ") or die ("Error: Unable to retrieve reward points from table user. " . mysql_error());
					$value = mysql_fetch_array ($rp);
					$_SESSION['new_rw'] = $value[0];
					}
				
				require_once ("view.php");	// acts like include (); displays the available food items in the menu 
				
				?>
		</div>
		
		<div id="tray" >
			<!--display the items in the tray-->
			<center><h2 style='color:#08c; font-size:22px;'> Food Tray</h2></center>
			<?php
				if($_SESSION['food'] == 0){																		// check if the cart is empty or not
						echo " <center><h1 id=\"cart\"> <i> Food tray is currently empty. </i> </h1></center>";	// notify the user that cart is empty
						$_SESSION['foodcount'] = 0;
						$_SESSION['food'] = 0;
						$_SESSION['tray'] = array();
						$_SESSION['pay'] = 0;
						}
				else {
					if(isset ($_GET['set']) ){
						$error = $_GET['set'];			// flag 'set' is stored in $error variable
						if ($error == 5) {				// if $error == 5 the display an error message
							echo "<center><h3 style='color:rgb(255,0,0);'> Insufficient Amount!<br /> Payment must be greater than or equal to total price.</h3><center>";
							}
						if ($error == 3) {				// if $error == 5 the display an error message
							echo "<center><h3 style='color:rgb(255,0,0);'> Some food items are not available.</h3><center>";
							}
						}
					
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
							$x = $_SESSION['tray'][$i][4];
							echo "<td id=\"item\"> <button><a id=\"cart\" href=\"javascript:confirmRemove('removeItem.php?flag=1&freebie={$x}&item={$n}') \"> Remove </a></button></td>"; // remove item
							echo "</tr>";														// closes a row
							if ($x == 1) $total += $_SESSION['tray'][$i][2];					// increment $total or the sum of the items
							else $total += 0;
							$codes[$i] = $_SESSION['tray'][$i][0];								// store to $codes all foodcodes
							$orderlist = $orderlist.$n.$delimeter;
							}
						}
					$_SESSION['total'] = $total;
					$_SESSION['orderlist'] = $orderlist;
					
					echo "<tr><td id=\"item\"></td><td id=\"item\">Total Price</td><td id=\"item\">{$total}</td><tr>";	// displays the total cost
					if (isset ($_SESSION['pay']) && $_SESSION['pay'] != 2) {
						echo "<button><a href='process_queue_orders.php?pay=1&x=1&payment={$total}' >Exact Amount</a></button> &nbsp; <button><a href='process_queue_orders.php?pay=2'>With Change</a></button>";
						}
					
					if (isset ($_SESSION['pay']) && $_SESSION['pay'] == 2) {
						if ($total != 0) {		// customer availed not only the freebies
							echo "<tr><td><br/><br/><b> Bills / Coins</b></td> <td><br/><br/><b>Number of Bills / Coins</b></td></tr>";
							echo "<tr><td> 5 </td><td> <input type='number' id='php5' min='0' max='20' value='0' onchange='computeValue()' /> </td> <td></td></tr>";
							echo "<tr><td> 10 </td><td> <input type='number' id='php10' min='0' max='20' value='0' onchange='computeValue()' /> </td> <td></td></tr>";
							echo "<tr><td> 20 </td><td> <input type='number' id='php20' min='0' max='20' value='0' onchange='computeValue()' /> </td> <td></td></tr>";
							echo "<tr><td> 50 </td><td> <input type='number' id='php50' min='0' max='20' value='0' onchange='computeValue()' /> </td> <td></td></tr>";
							echo "<tr><td> 100 </td><td> <input type='number' id='php100' min='0' max='20' value='0' onchange='computeValue()' /></td> <td> </td></tr>";
							echo "<tr><td> 200 </td><td> <input type='number' id='php200' min='0' max='20' value='0' onchange='computeValue()' /> </td> <td></td></tr>";
							echo "<tr><td> 500 </td><td> <input type='number' id='php500' min='0' max='20' value='0' onchange='computeValue()' /></td> <td> </td></tr>";
							echo "<tr><td> 1000 </td><td> <input type='number' id='php1000' min='0' max='20' value='0' onchange='computeValue()' /></td> <td> </td></tr>";
							}
							echo "<tr><td>  </td><td><form method='get' action='process_queue_orders.php'>";
							echo "<input type='hidden' name='payment' id='totalpayment' value='0'  > </input></td> <td> </td></tr>";
							echo "<tr><td>Total</td><td>";
							echo "<input type='text' name='amount' id='totalamount' value='0' disabled='disabled' > </input></td> <td> </td></tr>";
							echo "<tr><td> </td> <td><br/><input type='submit' value='Submit Order Now' /></form></td></tr>";
							echo "</table></center><br/>";
							$_SESSION["{$_SESSION['username']}"]['codes'] = $codes;
							// print_r ($codes);
						}
				}
				?>
				</table>
		</div>
	
	</article>
	<div style="clear:both;">	<!--footer and link to main page-->
		<center><a href="user.php" > Return to Main Page</a> </center>
		<?php require_once ("footer.php");			// acts like include(); displays the footer of the html ?>
	</div>