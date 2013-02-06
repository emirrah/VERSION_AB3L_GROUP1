<?php require_once ("header2.php"); ?>
	
	<article id="content">
		<center><table> <form method="post" action="process_addtomenu.php" >
			<tr> <h3> Add New Item in Menu</h3> </tr>
			<tr> 
			<td> </td> <td></td> <td> Food Code </td> <td> <input class="form" type="text" name="foodcode" required > </input> </td> 
			</tr>
			<tr>
			<?php 
				
				if (isset ($_GET['set'])){
					$error = $_GET['set'];
					if ($error == 1) {
						echo "<td></td><td></td><td></td><td style='color:red; font-size:12px;'> *food code already exists! </td>";
						}
					}
			?>
			</tr>
			<tr> 
			<td> </td> <td></td> <td> Food Description </td> <td> <textarea class="form" name="foodname" cols="20" rows="4" required ></textarea> </td>
			</tr>
			<tr> 
			<td> </td> <td></td> <td> Price </td> <td> <input class="form" type="number" name="price" min="1" required > </input> </td>
			</tr>
			<tr> 
			<td> </td> <td></td> <td> <input type="radio" name="available" value="1" checked="checked" /> Available</td>
							<td> <input type="radio" name="available" value="0" /> Not Available </td>
			</tr>
			<tr> 
			<td> </td> <td></td> <td> </td> <td> <input class="form" type="submit" value="Add to Menu"> </input> </td>
			</tr>
		</form></table></center>;
		<br/><br/><br/>
		
		<center><h2> Menu Items</h2><table>
		<?php
			$menu = mysql_query ("select * from menu;");
			
			echo "<tr> <td><b>Food Code</b> </td><td><b><center>Food Name </center></b></td><td> <b> Availability</b></td><td><b>Price </b></td></tr>";
			while ($item = mysql_fetch_array ($menu)) {
				echo "<tr>";
				echo "<td> <center>{$item[0]}</center></td>";
				echo "<td> {$item[1]}</td>";
				if ($item[3] == 1) echo "<td><center> Yes</center></td>";
				else echo "<td><center> No</center></td>";
				echo "<td> <center>{$item[2]}</center></td>";
				echo "</tr>";
				}
			mysql_close ($conn);
		?>
		</table></center>
		<br/><br/><br/>
		<center><a href="admin.php"> Return to Main Page</a></center>
	</article>
<?php require_once ("footer.php"); ?>