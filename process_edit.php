<!--
	This serves as the processing area.
	This file processes the editing/updating of food item in the database (table 'menu').
	
	htmlspecialchars() function treats the html characters (e.g. <html></html>, <p></p>, etc. ) as ordinary characters.
-->

<?php
	session_start ();										// starts a session
	require_once ("connect.php");							// build a connection to the database
	
	if (isset ($_SESSION['username'])) {					// if admin is logged in
		$user = $_SESSION['username'];
		if (isset ($_GET['item'])) {						// if the food code is passed from 'viewCurrentFoodItems.php' link "edit"
			$item = $_GET['item'];							// store food code passed in $item
			
			/* retrieve the information given by the user from the edititem.php page using $_POST['<input_field_name>']*/
			$newCode = htmlspecialchars ($_POST['newFoodCode']);
			$newFoodName = htmlspecialchars ($_POST['newFoodName']);
			$newprice = htmlspecialchars ($_POST['newPrice']);
			$available = htmlspecialchars ($_POST['available']);
			
			/* the next line updates the food item with reference to the food code specified by the admin; displays an error message if delete operation fails */
			mysql_query ("update menu set foodcode=\"{$newCode}\", foodname=\"{$newFoodName}\", price={$newprice}, available={$available} where foodcode=\"{$item}\"") or die ("Unable to update item. ".mysql_error());
			mysql_close ($conn);							// closes the connetion opened
			header ("Location: viewCurrentMenuItems.php");	// redirect to 'viewCurrentMenuItems.php' to view the changes made
			}
		}
		
	else {													// admin is not logged in
		mysql_close ($conn);								// closes connection opened
		header ("Location: index.php");						// return to login page
		}
?>