<?php require_once ("header.php"); ?>


		<center>
			<h2> <strong> All fields are required. <br/> Please fill up the form correctly. </h2> 
		</strong><form name="sign_up" method="post" action="process_signup.php">
		<br />
				
				<div style="height:365px; width:500px; border:1px solid #ccc; font:16px/26px Georgia,Garamond,Serif; overflow:auto;">
				<b><center> <table>
					<tr> <h3> USER'S PROFILE </h3></tr>
					<tr> 
					<td> </td> <td></td> <td> Username </td> <td> <input class="form" type="text" name="username" required > </input> </td>
					</tr>
					<tr>
					<?php 
						if (isset ($_GET['set'])){
							$error = $_GET['set'];
							if ($error == 2) {
								echo "<td></td><td></td><td></td><td style='color:red; font-size:10px;'> *username already exists! </td>";
								}
							}
					?>
					</tr>
					<tr> 
					<td> </td> <td></td>	<td> Password </td> <td> <input class="form" type="password" name="pw1" placeholder="more than 6 characters" required > </input> </td>
					</tr>
					<?php 
						if (isset ($_GET['set'])){
							$error = $_GET['set'];
							if ($error == 1) {
								echo "<td></td><td></td><td></td><td style='color:red; font-size:10px;'> *passwords do not match! </td>";
								}
							else if ($error == 4) {
								echo "<td></td><td></td><td></td><td style='color:red; font-size:10px;'> *must be more than 6 characters! </td>";
								}
							}
					?>
					<tr> 
					<td> </td> <td></td>	<td> Confirm Password </td> <td> <input class="form" type="password" name="pw2" placeholder="more than 6 characters" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td></td>	<td> Email Address </td> <td> <input class="form" type="email" name="email" placeholder="abc@yahoo.com" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td></td> 	<td> First Name </td> <td> <input class="form" type="text" name="fname" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td></td>	<td> Last Name </td> <td> <input class="form" type="text" name="lname" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td></td>	<td> Age </td> <td> <input class="form" type="number" name="age" min="18" value="18" required > </input> </td>
					</tr>
					<tr> 
					<td> </td> <td> </td><td>Birthday</td>
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
					<td> </td> <td></td>	<td> Address </td> <td> <textarea class="form" name="address" cols="17" rows="3" required ></textarea> </td>
					</tr>
					</table></center> </b>
				</div>
				
				
					<br />
					<center>
						<td> <input type="submit" value="Register Account"> </input> </td>
						<td> <input type="reset" value="Reset Form"> </td> <br/> <br/>
						<td> <a href="index.php"> Return to Main Page </a></td>
					</center>

		</form>
				
					
			</section>
			
<?php require_once ("footer.php"); ?>