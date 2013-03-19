<!--
Page Description:
	This page allows the admin to view current menu items.
	This displays the food code, food description, availability and price.
	Along with these are the links that enables the admin to edit and remove a specific food item.
-->


<script>
	/* This function asks the admin once whether s/he really wants to remove the sepecific food item from the menu. */
	function confirmRemove(remItem) {
		if (confirm("Are you sure you want to remove '" + remItem.substring(24)  + "' from the menu?")) {		/* if admin chooses 'OK', delete successful. Otherwise, no change.*/
			document.location = remItem;
			}
		}
</script>

<?php
	require_once ("header2.php"); 				// displays the header of the html
?>

		<div id='adminMenu'>
			<center><h2> Menu Items</h2><table>
			<?php
				$menu = mysql_query ("select * from menu;");		// retrieve the rows from table 'menu'
				
				echo "<tr> <td><b>Food Code</b> </td><td><b><center> Food Name</center> </b></td><td> <b>Available?</b></td><td><b>Price </b></td></tr>";
				while ($item = mysql_fetch_array ($menu)) {			// mysql_fetch_array() gets a line from $menu then assign it to $item as array
					echo "<tr>";
					echo "<td> <center>{$item[0]}</center></td>";				// food code
					echo "<td> {$item[1]}</td>";								// food description
					if ($item[3] == 1) echo "<td><center> Yes</center></td>";	// if availability == 1, print Yes.
					else echo "<td><center> No</center></td>";					// Otherwise, No.
					echo "<td> <center>{$item[2]}</center></td>";				// price
					echo "<td> <button><a href=\"edititem.php?item={$item[0]}\"> Edit </a></button></td>";									  // link edit with item='<foodcode>'
					echo "<td> <button><a href=\"javascript:confirmRemove('process_delete.php?item={$item[0]}')\"> Remove </a></button></td>"; // link remove with item='<foodcode>'
					echo "</tr>";
					}
				mysql_close ($conn);								// closes connection opened
			?>
			</table></center>
			<br/><br/><br/>
		</div>
	</article>
		<center><a href="admin.php"> Return to Main Page</a></center>
<?php require_once ("footer.php");	// acts like include(); displays the footer of the html ?>