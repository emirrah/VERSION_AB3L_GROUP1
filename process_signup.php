<!--
	This serves as the processing area.
	This file processes the logging in of users/admin in the site.
	
	htmlspecialchars() function treats the html characters (e.g. <html></html>, <p></p>, etc. ) as ordinary characters.
-->

<?php
	session_start();														// starts a session
	require_once ("connect.php");											// build a connection to the database
		
			/* retrieve the information given by the user during signup using $_POST['<input_field_name>']*/
		$username = htmlspecialchars($_POST['username']);
		$pw1 = htmlspecialchars($_POST['pw1']);
		$pw2 = htmlspecialchars($_POST['pw2']);
		$email = htmlspecialchars($_POST['email']);
		$fname = htmlspecialchars($_POST['fname']);
		$lname = htmlspecialchars($_POST['lname']);
		$cnum = htmlspecialchars($_POST['cnum']);
		$bmonth = htmlspecialchars($_POST['bmonth']);
		$bdate = htmlspecialchars($_POST['bdate']);
		$byear = htmlspecialchars($_POST['byear']);
		$address = htmlspecialchars($_POST['address']);
		$rewardpts = 0;											// reward points initially set to 0

			/* assign them to global $_SESSION['<input_field_name>'] for these values to  become accessible in the other pages */
		$_SESSION['uname'] = $username;
		$_SESSION['pw1'] = $pw1;
		$_SESSION['fname'] = $fname;
		$_SESSION['lname'] = $lname;
		$_SESSION['cnum'] = $cnum;
		$_SESSION['bmonth'] = $bmonth;
		$_SESSION['bdate'] = $bdate;
		$_SESSION['byear']= $byear;
		$_SESSION['address']= $address;
		$_SESSION['rewardpts'] = $rewardpts;
		
		$_SESSION['error'] = 1;

		$flag = 0;
		
		if ($pw1 != $pw2) {												// passwords do not match
				header("Location:signup.php?set=1");					// redirect to the same page (sign_up.php) with the error set=1
			}
			
		else if (strlen ($pw1) < 6 || strlen ($pw2) < 6) {				// passwords length is less than 6 characters
				header("Location:signup.php?set=4");					// redirect to the same page (sign_up.php) with the error set=4
			}
			
		else {
			$names = mysql_query ("select username from users;");		// retrieve all usernames from table 'users'
			while ($item = mysql_fetch_array ($names)) {				// mysql_fetch_array() gets a line from $names then assign it to $item as array
				if ($item[0] == $username) {							// checks if username given already exists in the database
					$flag = 1;											// seta flag to be equal to 1
					break;												// exit loop
					}
				}
				
			if ($flag === 1) {											// username already exists
				mysql_close ($conn);									// closes the connection opened
				header("Location: signup.php?set=2");					// return to the same page with set=2 which means that error is "username already exists!"
				}
				
			else {														// username does not exists
				$encpw = md5 ($pw1);									// encrypt password using md5()
				/* the next line inserts the information into the database (table 'users'); displays an error message if insert operation fails */
				mysql_query ("insert into users (username, password, email, fname, lname, cnum, bday, address, rewardpoints) values (\"{$username}\", \"{$encpw}\", \"{$email}\", \"{$fname}\", \"{$lname}\", \"{$cnum}\", \"{$bmonth} {$bdate}, {$byear}\", \"{$address}\", {$rewardpts}) ") or die ("Unable to insert in table users! ".mysql_error());
				mysql_close ($conn);									// closes connection opened
				header("Location: index.php?set=3");					// redirects to index.php or login page
				}
			}
?>