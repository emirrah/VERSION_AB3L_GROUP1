<!--
Page Description:
	This page allows the admin to edit/update food items in the database. 
	The admin may or may not modify/change the following information:
		- Food Code 
		- Food Description 
		- Price 
		- Avalability 
		
	There are also links to other pages and the logout link.
	
-->

<?php require_once ("header2.php");	 // acts like include(); displays the header of the html ?>		

	<article id="content">
		<center> <h2> Update Item</h2></center>
		<?php
			if (isset ($_GET['item'])) {	// $_GET['item'] holds the food code passed once admin chooses to edit the specific item; if a food code is passed
				$code = $_GET['item'];		// store the food code in variable $code
				
				$res = mysql_query ("select * from menu where foodcode=\"{$code}\"");	// retrieve the items from the database where the food code is the passed food code
				$item = mysql_fetch_array ($res);										// store the result in $item as an array
				echo "<center><table><form method=\"post\" action=\"process_edit.php?item={$code}\">";
				echo "<tr>";
				echo "<td id='add'> New Food Code: </td> <td id='add'> <input type=\"text\" name=\"newFoodCode\" value=\"{$item[0]}\"/></td>";	// default value is the old value
				echo "</tr>";
				echo "<tr>";
				echo "<td id='add'> New Food Description: </td> <td id='add'> <textarea name=\"newFoodName\" cols=\"25\" rows=\"4\">{$item[1]}</textarea></td>"; // default value is the old value
				echo "</tr>";
				echo "<tr>";
				echo "<td id='add'> New Price: </td> <td id='add'> <input type=\"number\" name=\"newPrice\" value=\"{$item[2]}\" /></td>"; // default value is the old value 
				echo "</tr>";
				echo "<tr>";
				echo "<td id='add'> New Image: </td> <td id='add'> <input type=\"file\" name=\"newImage\" value=\"{$item[4]}\" /></td>"; // default value is the old value 
				echo "</tr>";
				echo "<tr>";
					if ($item[3] == 1) {	// if old value is 1 or available, the default value is available
						echo "<td id='add'> <input type=\"radio\" name=\"available\" value=\"1\" checked=\"checked\"/> Available</td>";
						echo "<td id='add'> <input type=\"radio\" name=\"available\" value=\"0\"/> Not Available </td>";
						}
					elseif ($item[3] == 0){ // otherwise, the default value is not available
						echo "<td id='add'> <input type=\"radio\" name=\"available\" value=\"1\" /> Available</td>";
						echo "<td id='add'> <input type=\"radio\" name=\"available\" value=\"0\" checked=\"checked\"/> Not Available </td>";
						}
				echo "</tr>";
				echo "<td id='add'> </td><td id='add'><input type=\"submit\" value=\"Update Item\"/></td>"; // submit button
				echo "</tr>";
				echo "</form></table></center>";
			}
			
			mysql_close ($conn);	// closes the connection opened
		?>
	</article>

<?php require_once ("footer.php");	// acts like include(); displays the footer of the html?>		