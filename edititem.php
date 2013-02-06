<?php require_once ("header2.php");?>		

	<article id="content">
		<center> <h2> Update Item</h2></center>
		<?php
			if (isset ($_GET['item'])) {
				$code = $_GET['item'];
				
				$res = mysql_query ("select * from menu where foodcode=\"{$code}\"");
				$item = mysql_fetch_array ($res);
				echo "<center><table><form method=\"post\" action=\"process_edit.php?item={$code}\">";
				echo "<tr>";
				echo "<td id='add'> New Food Code: </td> <td id='add'> <input type=\"text\" name=\"newFoodCode\" value=\"{$item[0]}\"/></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td id='add'> New Food Description: </td> <td id='add'> <textarea name=\"newFoodName\" cols=\"25\" rows=\"4\">{$item[1]}</textarea></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td id='add'> New Price: </td> <td id='add'> <input type=\"number\" name=\"newPrice\" value=\"{$item[2]}\" /></td>";
				echo "</tr>";
				echo "<tr>";
					if ($item[3] == 1) {
						echo "<td id='add'> <input type=\"radio\" name=\"available\" value=\"1\" checked=\"checked\"/> Available</td>";
						echo "<td id='add'> <input type=\"radio\" name=\"available\" value=\"0\"/> Not Available </td>";
						}
					elseif ($item[3] == 0){
						echo "<td id='add'> <input type=\"radio\" name=\"available\" value=\"1\" /> Available</td>";
						echo "<td id='add'> <input type=\"radio\" name=\"available\" value=\"0\" checked=\"checked\"/> Not Available </td>";
						}
				echo "</tr>";
				echo "<td id='add'> </td><td id='add'><input type=\"submit\" value=\"Update Item\"/></td>";
				echo "</tr>";
				echo "</form></table></center>";
			}
			
			mysql_close ($conn);
		?>
	</article>

<?php require_once ("footer.php");?>		