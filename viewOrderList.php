<!--
Page Description:
	This page allows the admin to view current ordered items.
	This displays the order number, customer, food codes of food items and total price.
	Along with these are the links that enables the admin remove finished ordered item.
-->


<script>
	/* This function asks the admin once whether s/he really wants to remove the sepecific food item from the orderqueue. */
	function confirmRemove(remItem) {
		
		if (confirm("Is this order already finished?")) {						/* if admin chooses 'OK',continue. Otherwise, no change.*/
			if (confirm("Are you sure you want to remove this item?")) {		/* if admin chooses 'OK', delete successful. Otherwise, no change.*/
				document.location = remItem;
			}
		}
	}
</script>

<?php
	require_once ("header2.php"); 				// displays the header of the html
?>
		<div id="adminMenu">
			<center><table>
			<?php
				$orderqueue = mysql_query ("select * from orderqueue;");		// retrieve the rows from table 'orderqueue'
				
				if(mysql_num_rows($orderqueue) === 0){
					echo " <center><h1 id=\"cart\"> <i> There are currently no orders. </i> </h1></center><br /><br />";	
				}
				else{
					echo " <center><h1 id=\"cart\"> <i> Ordered Items </i> </h1></center>";	
					echo "<tr> <td><b>Order No.</b> </td><td><b><center>Customer</center> </b></td><td> <b><center>Food Codes</center></b></td><td><b>Total</b></td><td><b>Payment</b></td></tr>";
					while ($item = mysql_fetch_array ($orderqueue)) {				// mysql_fetch_array() gets a line from $orderqueue then assign it to $item as array
						echo "<tr>";
						echo "<td> <center>{$item[0]}</center></td>";				// order_number
						echo "<td> <center><a href=\"viewAccount2.php?uname={$item[1]}\">{$item[1]}</a></center></td>";				// customer
						echo "<td> <center>{$item[2]}</center></td>";				// foodcodes
						echo "<td> <center>{$item[3]}</center></td>";				// total
						echo "<td> <center>{$item[4]}</center></td>";				// payment
						echo "<td> <button><a href=\"javascript:confirmRemove('process_delete_order.php?item={$item[0]}')\"> Remove </a></button></td>"; // link remove with item='<order_number>'
						echo "</tr>";
					}
				}
				mysql_close ($conn);				// closes connection opened
			?>
			</table></center>
			<br/><br/><br/>
			<center><a href="admin.php"> Return to Main Page</a></center>
		</div>
	</article>	
	
<?php require_once ("footer.php");				// acts like include(); displays the footer of the html ?>