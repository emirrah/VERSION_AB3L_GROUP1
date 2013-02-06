<?php
		session_start();
		
		$username = htmlspecialchars($_POST['username']);			// get the values given by the user;
		$pw1 = htmlspecialchars($_POST['pw1']);			// htmlspecialchars() catches the special characters given by the user;
		$pw2 = htmlspecialchars($_POST['pw2']);			// also, it strengthens the security of the page
		$email = htmlspecialchars($_POST['email']);
		$fname = htmlspecialchars($_POST['fname']);
		$lname = htmlspecialchars($_POST['lname']);
		$bmonth = htmlspecialchars($_POST['bmonth']);
		$bdate = htmlspecialchars($_POST['bdate']);
		$byear = htmlspecialchars($_POST['byear']);
		$address = htmlspecialchars($_POST['address']);
		$rewardpts = 0;

	  // assign them to global $_SESSION[''] for these values become accessible in the other pages
		$_SESSION['uname'] = $username;
		$_SESSION['pw1'] = $pw1;
		$_SESSION['fname'] = $fname;
		$_SESSION['lname'] = $lname;
		$_SESSION['bmonth'] = $bmonth;
		$_SESSION['bdate'] = $bdate;
		$_SESSION['byear']= $byear;
		$_SESSION['address']= $address;
		
		$_SESSION['error'] = 1;

		$flag = 0;
		
		require_once ("connect.php");
		
		if ($pw1 != $pw2) {	// passwords are not the same
				header("Location:signup.php?set=1");					// redirect to the same page (sign_up.php) with the error set=1
			}
		else if (strlen ($pw1) < 6 || strlen ($pw2) < 6) {
				header("Location:signup.php?set=4");					// redirect to the same page (sign_up.php) with the error set=4
			}
		else{	
			$names = mysql_query ("select username from users;");
			while ($item = mysql_fetch_array ($names)) {
				if ($item[0] == $username) {
					$flag = 1;
					break;
					}
				}
				
			if ($flag === 1) {
				mysql_close ($conn);
				echo "<script> alert(\"Username already exists!\")</script>";
				header("Location: signup.php?set=2");
				}
				
			else {
				$encpw = md5 ($pw1);
				mysql_query ("insert into users (username, password, email, fname, lname, bday, address, rewardpoints) values (\"{$username}\", \"{$encpw}\", \"{$email}\", \"{$fname}\", \"{$lname}\", \"{$bmonth} {$bdate}, {$byear}\", \"{$address}\", {$rewardpts}) ") or die ("Unable to insert in table users! ".mysql_error());
				mysql_close ($conn);
				header("Location: index.php?set=3");						// redirects to index.php
				}
			}
?>