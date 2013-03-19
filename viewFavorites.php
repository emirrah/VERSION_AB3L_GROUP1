<!--
	Displays the
-->
<?php require_once ("header.php"); //includes the header.php ?>

<script>
	/* This function asks the admin once whether s/he really wants to remove the sepecific food item from the menu. */
	function confirmRemove(remItem) {
		if (confirm("Are you sure you want to remove '" + remItem.substring(31)  + "' from favorites list?")) {		/* if admin chooses 'OK', delete successful. Otherwise, no change.*/
			document.location = remItem;
			}
		}
</script>


	<article id="greet">
		<?php
			if (isset ($_SESSION['username'])) {	//checks if the user is logged in
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
		<?php
			$str = "";
			$i = 1;
			
			$result = mysql_query ("select * from favorites where customer=\"{$_SESSION['username']}\"; ") or die ("Unable to retrieve items from favorites.");
			
			echo "Customer: {$_SESSION['username']}<br/>";
			echo "<table><tr> <td> <b>Number</b></td> <td><b><center>Favorite</center></b></td> <td><b> Total Price</b></td></tr>";
			while ($item = mysql_fetch_array ($result)) {
				echo "<tr><td> {$i}</td><td>";
				$str = strtok ($item[1], " ");		// favorite_codes
				
				while ($str != false) {
					$result1 = mysql_query ("select * from menu where foodcode=\"{$str}\"; ") or die ("Unable to retrieve items." . mysql_error());
						while ($value = mysql_fetch_array ($result1) ) {
							echo "{$value[0]} - {$value[1]} <br/>";
							}
					
					$str = strtok (" ");
					}
				
				echo "</td><td>{$item[2]}</td>";
				
				echo "<td id=\"item\"> <button><a id=\"cart\" href=\"addtotray.php?flag=2&favcodes={$item[1]}&price={$item[2]} \">Avail Now</a></button></td>";
				echo "<td id=\"item\"> <button><a id=\"cart\" href=\"javascript:confirmRemove('removeItem.php?flag=3&favcodes={$item[1]}') \"> Remove</a></button></td></tr>"; // remove item
				$i += 1;
				}
			echo "</table>";
		?>
	
	</article>
	
	
	<div style="clear:both;">
		<br/><br/>
		<center><a href="user.php" > Return to Main Page</a> </center>
		<?php require_once ("footer.php"); //includes the footer.php ?>
	</div>