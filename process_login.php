<!--
	This serves as the processing area.
	This file processes the logging in of users/admin in the site.
	
	htmlspecialchars() function treats the html characters (e.g. <html></html>, <p></p>, etc. ) as ordinary characters.
-->

<?php
	session_start();														// starts a session
	require_once ("connect.php");											// build a connection to the database
	
	/* retrieve the information given by the user during login using $_POST['<input_field_name>']*/
	$user = htmlspecialchars($_POST['username']);
	$pw = htmlspecialchars ($_POST['pw']);
	$pw1 = md5(htmlspecialchars($_POST['pw']));
	
		/* for the admin's login */
	if (strtolower($user) === "admin" && strtolower($pw) === "admin"){	// admin' username and password is 'admin'
		$_SESSION['username'] = $user;										// store the username to $_SESSION['username'] to make it available in different pages
		header ("Location: admin.php");										// redirect to the admin page
		}
		
		/* for the other user's login */
	else {
		$_SESSION['food'] = 0;
		$_SESSION['foodcount'] = 0;
		$_SESSION['tray'] = array();
		$_SESSION['favorites'] = array();
		$_SESSION['favcount'] = 0;
		$_SESSION['fav'] = 0;		
				
		$accounts = mysql_query ("select * from users");					// retrieve all the username from table 'users'
		$flag = 0;
		
		while ($users = mysql_fetch_array ($accounts)) {					// mysql_fetch_array() gets a line from $accounts then assign it to $users as array
			if ($users[0] === $user && $users[1] === $pw1) {				// checks if username and password given match
				$_SESSION['username'] = $user;								// store the username to $_SESSION['username'] to make it available in different pages
				$flag = 1;													// sets flag to be equal to 1
				
				$rp = mysql_query ("select rewardpoints from users where username=\"{$_SESSION['username']}\" ") or die ("Error: Unable to retrieve reward points from table user. " . mysql_error());
					
				$value = mysql_fetch_array ($rp);
				$_SESSION['new_rw'] = $value[0];
				
				mysql_close ($conn);										// closes connection opened
				header ("Location: user.php");								// redirect to user page
				}
			}
		
		if ($flag === 0) {													// if password and username do not match
			mysql_close ($conn);											// closes connection opened
			header ("Location: index.php?set=1");							// redirect to login page with set=1 which means that there's an error
			}
		}
?>