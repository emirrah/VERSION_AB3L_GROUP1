<?php require_once ("header.php"); ?>
			<article id="login">
			<br />
			<br />
			<br />
				<center><table>
					<form action="process_login.php" method="post">
						<tr> <?php 
								if (isset ($_GET['set'])) {
									if ($_GET['set'] == 3)
										echo "<h1> Congratulations! Create account is successful! </h1>";
									}
							?></tr>
						<tr> <h1> Welcome to Online Food Ordering System! </h1> </tr>
						<tr>
							<td id="add"> Username </td>
							<td id="add"> <input type="text" name="username" placeholder="required" required/></td>
						</tr>
						<tr>
							<td id="add"> Password </td>
							<td id="add"> <input type="password" name="pw" placeholder="required" required/></td>
						</tr>
						<tr>
							<?php 
								if (isset ($_GET['set'])) {
									$error = $_GET['set'];
									if ($error == 1) {
										echo "<td></td><td style='color:red; font-size:12px;'> * Invalid username or password! </td>";
										}
									}
							?>
						</tr>
						<tr>
							<td id="add"> </td>
							<td id="add"><input type="submit" value="login" /> </td>
						</tr>
						<tr>
							<td id="add"> </td>
							<td id="add"><br/><br/>Do not have an account?<a href="signup.php" ><br/>Create Account </a></td>
						</tr>
					</form>
				</table>
				</center>
			</article>
			<br/><br/><br/>
			<article id="content">
				<center><h2> Menu of the Day! </h2><table>
				<?php
					$menu = mysql_query ("select * from menu;");
					
					echo "<tr> <td><b>Food Code</b> </td><td><b><center>Food Name</center> </b></td><td><b>Price </b></td></tr>";
					while ($item = mysql_fetch_array ($menu)) {
						if ($item[3] == 1) {
							echo "<tr>";
							echo "<td> <center>{$item[0]}</center></td>";
							echo "<td> {$item[1]}</td>";
							echo "<td> <center>{$item[2]}</center></td>";
							echo "</tr>";
							}
						}
					mysql_close ($conn);
				?>
				</table></center>
				<br/><br/><br/>
			</article>
			<br/>
			<br/>
<?php require_once ("footer.php"); ?>