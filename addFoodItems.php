<!--
Page Description:
	This page allows the admin to add food items in the database. 
	The admin must supply the following information:
		- Food Code (varchar)
		- Food Description (varchar)
		- Price (integer)
		- Avalability (boolean)
		
	Along with this page is the complete list of the Menu items contained in a table.
	There are also links to other pages and the logout link.
	
-->

<?php require_once ("header2.php");		// acts like include(); displays the header of the html ?>
	
		<center><table> <form method="post" action="process_addtomenu.php" enctype="multipart/form-data" >
			<?php 
				if (isset ($_GET['set'])){			// $_GET['set'] acts like the flag; this line means that flag 'set' is passed
					$error = $_GET['set'];			// flag 'set' is stored in $error variable
					if ($error == 5) {				// if $error == 5 the display an error message below the Food Code input field
						echo "<tr> <h3 style='color:red;'> Food Item is successfully added! </h3></tr>";
						}
					}
			?>
			<tr> <h3> Add New Item in Menu</h3> </tr>
			<tr> 
			<td> </td> <td></td> <td> Food Code </td> <td> <input class="form" type="text" name="foodcode" required > </input> </td> 
			</tr>
			<tr>
			<?php 
				if (isset ($_GET['set'])){			// $_GET['set'] acts like the flag; this line means that flag 'set' is passed
					$error = $_GET['set'];			// flag 'set' is stored in $error variable
					if ($error == 1) {				// if $error == 1 the display an error message below the Food Code input field
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
			<td> </td> <td></td> <td> <input type="radio" name="available" value="1" checked="checked" /> Available</td>  <!-- default value -->
							<td> <input type="radio" name="available" value="0" /> Not Available </td>
			</tr>
			<tr> 
			<td> </td> <td></td> <td> Image </td> <td> <input class="form" type="file" name="image" placeholder=" Required" required > </input> </td>
			</tr>
			<tr> 
			<td> </td> <td></td> <td> </td> <td id='add'><br/> <input class="form" type="submit" value="Add to Menu"> </input> </td>
			</tr>
		</form></table></center>
		<br/><br/><br/>
		
		<center><h2> Menu Items</h2><table>
		<?php
			$menu = mysql_query ("select * from menu;");					// retrieve all items from table 'menu'
			
			echo "<tr> <td><b>Food Code</b> </td><td><b><center>Food Name </center></b></td><td> <b> Availability</b></td><td><b>Price </b></td></tr>";
			while ($item = mysql_fetch_array ($menu)) {						// mysql_fetch_array() gets a line from $menu then assign it to $item as array
				echo "<tr>";
				echo "<td> <center>{$item[0]}</center></td>";				// Food code	
				echo "<td> {$item[1]}</td>";								// Food description
				if ($item[3] == 1) echo "<td><center> Yes</center></td>";	// Availability
				else echo "<td><center> No</center></td>";					
				echo "<td> <center>{$item[2]}</center></td>";				// Price
				echo "</tr>";
				}
			mysql_close ($conn);											// closes the connection opened
		?>
		</table></center>
		<br/><br/><br/>
		<center><a href="admin.php"> Return to Main Page</a></center>		<!-- link to admin.php -->
	</article>
	
<?php require_once ("footer.php");	// acts like include(); displays the footer of the html ?>