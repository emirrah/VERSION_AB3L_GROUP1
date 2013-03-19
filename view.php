<!--
	This is just a portion of the page.
	This retrieve the all food items from the menu and displays the available food items including their Food Code, Food Description, and Price.
-->

<script>
	/* This function asks the admin once whether s/he really wants to remove the sepecific food item from the menu. */
	function confirmAdd(remItem) {
		if (confirm("Are you sure you want to add '" + remItem.substring(19)  + "' to your food tray?")) {		/* if admin chooses 'OK', delete successful. Otherwise, no change.*/
			document.location = remItem;
		}
	}
</script>
	
	<?php
		if (isset ($_SESSION['username'])) {						// checks if user is logged in
			$menu = mysql_query ("select * from menu;");			// retrieve rows of the table 'menu'
			$i = 0;
			
			echo "<table>";
			while ($item = mysql_fetch_array ($menu)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
				if (($i-2) % 3 === 1) {
					if ($item[3] == 1) {							// checks if the food item is available (availability == 1)
						echo "<tr>";
						echo "<td class='menuImg'> <a href=\"addtotray.php?item={$item[0]}&flag=3\"><img class=\"menuItems\" src=\"images/{$item[4]}\" /> </a>";
						echo "<a href=\"addtotray.php?item={$item[0]}&flag=3\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
						//item[0] is the foodcode and item[4] is the image name
						$i += 1;
						}
					}
					
				else {
					if ($item[3] == 1) {							// checks if the food item is available (availability == 1)
						//echo "<tr>";
						echo "<td class='menuImg'> <a href=\"addtotray.php?item={$item[0]}&flag=3\"><img class=\"menuItems\" src=\"images/{$item[4]}\" /> </a>";
						echo "<a href=\"addtotray.php?item={$item[0]}&flag=3\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
						//item[0] is the foodcode and item[4] is image name
						$i += 1;
						}
					}
				if (($i-2) % 3 === 3) {
					echo "</tr>";
					$i += 1;
					}
				}
			$rw_pt = $_SESSION['new_rw'];		//set reward points
			
			echo "</table>";
			
			//Freebies available for current reward points
			echo "<br/><h2 style='color:green;'> List of Freebies</h2>";
			echo "<table>";
		
			if ($rw_pt >= 30 && $rw_pt < 45) {
				$free = mysql_query ("select * from menu where price < 30") or die ("Error: Unable to retrueve items from menu. " . mysql_error());
				
				echo "<tr> <td><b>Food Code</b> </td><td><b>Food Name </b></td><td><b>Price </b></td></tr>";
				while ($item = mysql_fetch_array ($free)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
					if ($item[3] == 1) {								// checks if the food item is available (availability == 1)
						echo "<tr>";
						echo "<td> {$item[0]}</td>";					// Food Code
						echo "<td> {$item[1]}</td>";					// Food Description
						echo "<td> <center>{$item[2]}</center></td>";	// Price
						echo "<td> <a href=\"addtotray.php?item={$item[0]}&flag=4&rew_pt={$rw_pt}\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
						echo "</tr>";
						}
					}
				}
				
			else if ($rw_pt >= 45 && $rw_pt < 60) {
				$free = mysql_query ("select * from menu where price < 40") or die ("Error: Unable to retrueve items from menu. " . mysql_error());
				
				echo "<tr> <td><b>Food Code</b> </td><td><b>Food Name </b></td><td><b>Price </b></td></tr>";
				while ($item = mysql_fetch_array ($free)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
					if ($item[3] == 1) {								// checks if the food item is available (availability == 1)
						echo "<tr>";
						echo "<td> {$item[0]}</td>";					// Food Code
						echo "<td> {$item[1]}</td>";					// Food Description
						echo "<td> <center>{$item[2]}</center></td>";	// Price
						echo "<td> <a href=\"addtotray.php?item={$item[0]}&flag=4&rew_pt={$rw_pt}\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
						echo "</tr>";
						}
					}
				}
			
			else if ($rw_pt >= 60 && $rw_pt < 80) {
				$free = mysql_query ("select * from menu where price < 50") or die ("Error: Unable to retrueve items from menu. " . mysql_error());
				
				echo "<tr> <td><b>Food Code</b> </td><td><b>Food Name </b></td><td><b>Price </b></td></tr>";
				while ($item = mysql_fetch_array ($free)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
					if ($item[3] == 1) {								// checks if the food item is available (availability == 1)
						echo "<tr>";
						echo "<td> {$item[0]}</td>";					// Food Code
						echo "<td> {$item[1]}</td>";					// Food Description
						echo "<td> <center>{$item[2]}</center></td>";	// Price
						echo "<td> <a href=\"addtotray.php?item={$item[0]}&flag=4&rew_pt={$rw_pt}\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
						echo "</tr>";
						}
					}
				}
			
			else if ($rw_pt >= 80 && $rw_pt < 100) {
				$free = mysql_query ("select * from menu where price < 60") or die ("Error: Unable to retrueve items from menu. " . mysql_error());
				
				echo "<tr> <td><b>Food Code</b> </td><td><b>Food Name </b></td><td><b>Price </b></td></tr>";
				while ($item = mysql_fetch_array ($free)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
					if ($item[3] == 1) {								// checks if the food item is available (availability == 1)
						echo "<tr>";
						echo "<td> {$item[0]}</td>";					// Food Code
						echo "<td> {$item[1]}</td>";					// Food Description
						echo "<td> <center>{$item[2]}</center></td>";	// Price
						echo "<td> <a href=\"addtotray.php?item={$item[0]}&flag=4&rew_pt={$rw_pt}\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
						echo "</tr>";
						}
					}
				}
				
			else if ($rw_pt >= 100 && $rw_pt < 150) {
				$free = mysql_query ("select * from menu where price < 80") or die ("Error: Unable to retrueve items from menu. " . mysql_error());
				
				echo "<tr> <td><b>Food Code</b> </td><td><b>Food Name </b></td><td><b>Price </b></td></tr>";
				while ($item = mysql_fetch_array ($free)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
					if ($item[3] == 1) {								// checks if the food item is available (availability == 1)
						echo "<tr>";
						echo "<td> {$item[0]}</td>";					// Food Code
						echo "<td> {$item[1]}</td>";					// Food Description
						echo "<td> <center>{$item[2]}</center></td>";	// Price
						echo "<td> <a href=\"addtotray.php?item={$item[0]}&flag=4&rew_pt={$rw_pt}\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
						echo "</tr>";
						}
					}
				}
			
			else if ($rw_pt >= 150) {
				$free = mysql_query ("select * from menu where price <= 100") or die ("Error: Unable to retrueve items from menu. " . mysql_error());
				
				echo "<tr> <td><b>Food Code</b> </td><td><b>Food Name </b></td><td><b>Price </b></td></tr>";
				while ($item = mysql_fetch_array ($free)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
					if ($item[3] == 1) {								// checks if the food item is available (availability == 1)
						echo "<tr>";
						echo "<td> {$item[0]}</td>";					// Food Code
						echo "<td> {$item[1]}</td>";					// Food Description
						echo "<td> <center>{$item[2]}</center></td>";	// Price
						echo "<td> <a href=\"addtotray.php?item={$item[0]}&flag=4&rew_pt={$rw_pt}\"> Add to Tray</a></td>";	// Link that Adds the specific food items in the virtual tray
						echo "</tr>";
						}
					}
				}
			
			else echo "<center> <h3> Reward points is not enough to avail the freebies! <a href='about.php'>Learn More</a></h3> </center><br/>";
		}
	
	else {														// user is not logged in
		header ("Location: index.php");							// redirect to login page
		}
	?>
	
	</table></center>
	<br/><br/><br/>