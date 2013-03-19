<!--
	This serves as the processing area.
	This file processes the addition of food item in the database (table 'menu').
	
	htmlspecialchars() function treats the html characters (e.g. <html></html>, <p></p>, etc. ) as ordinary characters.
-->

<?php
	session_start ();										// starts a session
	require_once ("connect.php");							// build a connection to the database
	
	if (isset ($_SESSION['username'])) {					// if admin is logged in
		$user = $_SESSION['username'];
		/* retrieve the information given by the user from the addFoodItems.php page using $_POST['<input_field_name>']*/
		$foodcode = htmlspecialchars ($_POST['foodcode']);
		$foodname = htmlspecialchars ($_POST['foodname']);
		$price = htmlspecialchars ($_POST['price']);
		$available = htmlspecialchars ($_POST['available']);
		
		$file = htmlspecialchars ($_FILES['image']['name']);
		$src = $_FILES['image']['tmp_name'];					// assign the location of the file to a temporary variable
		move_uploaded_file ($src, "images/".$file);				// syntax: move_uploaded_file (<source>, <destination>);
		
		$flag = 0;
		
		
		$codes = mysql_query ("select foodcode from menu;");	// retrieve all the food codes from table 'menu'
		
		while ($c = mysql_fetch_array ($codes)) {				// mysql_fetch_array() gets a line from $code then assign it to $c as array
			if ($c[0] === $foodcode) {							// checks if food code given already exists
				$flag = 1;										// sets the flag to be equal to 1
				break;											// exit while() loop
				}
			}
		
		if ($flag == 0) {										// food code does not exist in the table 'menu'
						/* the next line inserts the food item added by the admin; displays an error message if insert operation fails */
			mysql_query ("insert into menu values (\"{$foodcode}\", \"{$foodname}\", {$price}, {$available}, \"{$file}\") ") or die ("Unable to insert to table menu.");
			mysql_close ($conn);								// closes the connection opened
			
			header ("Location: addFoodItems.php?set=5");		// redirect to 'addFoodItems.php' with set=5 which means addition's successful
			}
		else {													// food code already exists
			header ("Location: addFoodItems.php?set=1");		// redirect to 'addFoodItems.php' with set=1 which means that there is an error encountered
			}
		}
	
	else {													// admin is not logged in
		mysql_close ($conn);								// closes connection opened
		header ("Location: index.php");						// return to login page
		}
?>