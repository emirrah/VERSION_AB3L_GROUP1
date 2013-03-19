<!--
Page Description:
	This page allows the user to create an account.
	Account creation would not be successful the user entered a username being used by other user.	
-->

<?php require_once ("header.php");	 // acts like include(); displays the header of the html ?>

		<center>
			<h2 style='color:#08c;'> <strong> All fields are required. <br/> Please fill up the form correctly. </h2> 
		</center>
		</strong><form name="sign_up" method="post" action="process_signup.php">
			<div id="sign_up">
				<center> <table>
					<tr> <h3 style='color:#08c;'> USER'S PROFILE </h3></tr>
					<tr> 
					<td> </td> <td></td> <td style='color:#08c;'> Username </td> <td> <input class="form" type="text" name="username" required > </input> </td>
					</tr>
					<tr>
					<?php 
						if (isset ($_GET['set'])){			// $_GET['set'] acts like the flag; this line means that flag 'set' is passed
							$error = $_GET['set'];			// flag 'set' is stored in $error variable
							if ($error == 2) {				// if $error == 2 the display an error message below the username input field
								echo "<td></td><td></td><td></td><td style='color:red; font-size:10px;'> *username already exists! </td>";
								}
							}
					?>
					</tr>
					<tr> 
					<td> </td> <td></td>	<td style='color:#08c;'> Password </td> <td> <input class="form" type="password" name="pw1" placeholder="more than 6 characters" required > </input> </td>
					</tr>
					<?php 
						if (isset ($_GET['set'])){			// $_GET['set'] acts like the flag; this line means that flag 'set' is passed
							$error = $_GET['set'];			// flag 'set' is stored in $error variable
							if ($error == 1) {				// if $error == 1 the display an error message below the password input field; passwords don't match
								echo "<td></td><td></td><td></td><td style='color:red; font-size:10px;'> *passwords do not match! </td>";
								}
							else if ($error == 4) {			// if $error == 1 the display an error message below the password input field; passwords' length less than the specifed
								echo "<td></td><td></td><td></td><td style='color:red; font-size:10px;'> *must be more than 6 characters! </td>";
							}
						}
					?>
					<tr> 
					<td> </td> <td></td>	<td style='color:#08c;'> Confirm Password </td> <td> <input class="form" type="password" name="pw2" placeholder="more than 6 characters" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td></td>	<td style='color:#08c;'> Email Address </td> <td> <input class="form" type="email" name="email" placeholder="abc@yahoo.com" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td></td> 	<td style='color:#08c;'> First Name </td> <td> <input class="form" type="text" name="fname" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td></td>	<td style='color:#08c;'> Last Name </td> <td> <input class="form" type="text" name="lname" required > </input> </td>
					</tr>
					<tr>
					<td> </td> <td></td>	<td style='color:#08c;'> Contact Number </td> <td> <input class="form" type="text" name="cnum" pattern="[0-9]{11}" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td></td>	<td style='color:#08c;'> Age </td> <td> <input class="form" type="number" name="age" min="18" value="18" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td> </td><td style='color:#08c;'>Birthday</td>
					<td><select name="bmonth">
						<option value="January">January</option>
						<option value="February">February</option>
						<option value="March">March</option>
						<option value="April">April</option>
						<option value="May">May</option>
						<option value="June">June</option>
						<option value="July">July</option>
						<option value="August">August</option>
						<option value="September">September</option>
						<option value="October">October</option>
						<option value="November">November</option>
						<option value="December">December</option>
						</select>
						
						<input class="form" type="number" name="bdate" min="1" max="31" value="1" required > </input>
						<input class="form" type="number" name="byear" min="1900" max="1994" value="1994" required > </input>
					</td>
					</tr>
					<tr> 
					<td> </td> <td></td> <td style='color:#08c;'> Address </td> <td> <textarea class="form" name="address" cols="17" rows="3" required ></textarea> </td>
					</tr>
				</table></center>
			</div>
			
			<center>
				<td> <input type="submit" value="Register Account"> </input> </td>
				<td> <input type="reset" value="Reset Form"> </td> <br/> <br/>
				<td> <a href="index.php" style='font-size: 18px'> Return to Main Page </a></td>
			</center>
			
		</form>
		</section>
			
<?php require_once ("footer.php");	// acts like include(); displays the footer of the html ?>