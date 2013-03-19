<?php require_once ("header.php"); ?>

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
			if (isset ($_GET['flag']) && isset ($_GET['rewpt']) && $_GET['flag'] == 7) {			// use reward points
				$rw_pt = $_GET['rewpt'];
				
				echo $rw_pt;
				
				echo "<table>";
				
				if ($rw_pt >= 30 && $rw_pt < 40) {
					$free = mysql_query ("select * from menu where price < 30; ") or die ("Error: Unable to retrueve items from menu. " . mysql_error());
					
					echo "<tr> <td><b>Food Code</b> </td><td><b>Food Name </b></td><td><b>Price </b></td></tr>";
					while ($item = mysql_fetch_array ($free)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
						if ($item[3] == 1) {								// checks if the food item is available (availability == 1)
							echo "<tr>";
							echo "<td> {$item[0]}</td>";					// Food Code
							echo "<td> {$item[1]}</td>";					// Food Description
							echo "<td> <center>{$item[2]}</center></td>";	// Price
							echo "<td> <a href=\"addtotray.php?item={$item[0]}&flag=3\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
							echo "</tr>";
							}
						}
					}
				
				else if ($rw_pt >= 40 && $rw_pt < 50) {
					
					}
				
				else if ($rw_pt >= 50 && $rw_pt < 65) {
					echo "good";
					}
				
				else if ($rw_pt >= 65 && $rw_pt < 90) {
					
					}
				
				else if ($rw_pt >= 90 && $rw_pt < 160) {
					
					}
				
				else if ($rw_pt >= 160) {
					
					}
				
				else {
					header ("Location: user.php?set=1");
					}
				}
			echo "</table>";
		?>
	
	</article>
	
	
	<div style="clear:both;">
		<br/><br/>
		<center><a href="user.php" > Return to Main Page</a> </center>
		<?php require_once ("footer.php"); ?>
	</div>