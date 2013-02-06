<script>	//script alert for removing item
	function confirmRemove(remItem) {
		if (confirm("Are you sure you want to remove this item?")) {
			document.location = remItem;
			}
		}
</script>

<?php
	require_once ("header2.php"); 
	require_once ("connect.php");
?>

	<article id="content">
		<center><h2> Menu Items</h2><table>
		<?php
			$menu = mysql_query ("select * from menu;");
			
			echo "<tr> <td><b>Food Code</b> </td><td><b><center> Food Name</center> </b></td><td> <b>Available?</b></td><td><b>Price </b></td></tr>";
			while ($item = mysql_fetch_array ($menu)) {
				echo "<tr>";
				echo "<td> <center>{$item[0]}</center></td>";
				echo "<td> {$item[1]}</td>";
				if ($item[3] == 1) echo "<td><center> Yes</center></td>";
				else echo "<td><center> No</center></td>";
				echo "<td> <center>{$item[2]}</center></td>";
				echo "<td> <a href=\"edititem.php?item={$item[0]}\"> Edit </a></td>";
				echo "<td> <a href=\"javascript:confirmRemove('process_delete.php?item={$item[0]}')\"> Remove </a></td>";
				echo "</tr>";
				}
			mysql_close ($conn);
		?>
		</table></center>
		<br/><br/><br/>
		<center><a href="admin.php"> Return to Main Page</a></center>
	</article>
	
	
<?php require_once ("footer.php"); ?>