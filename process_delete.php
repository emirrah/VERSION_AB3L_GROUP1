<!--
	This serves as the processing area.
	This file processes the removal of food item in the database (table 'menu').
-->

<?php
	session_start ();										// starts a session
	require_once ("connect.php");							// build a connection to the database
	
	if (isset ($_SESSION['username'])) {					// if admin is logged in
		$user = $_SESSION['username'];
		if (isset ($_GET['item'])) {						// if the food code is passed from 'viewCurrentFoodItems.php' link "Remove"
			$item = $_GET['item'];							// store food code passed in $item
				
				/* the next line deletes the food item given the food code specified by the admin; displays an error message if delete operation fails */
			mysql_query ("delete from menu where foodcode=\"{$item}\" ") or die ("Unable to delete item. ".mysql_error());
			header ("Location: viewCurrentMenuItems.php");	// redirects to viewCurrentMenuItems.php to view the changes
			}
		mysql_close ($conn);								// closes connection opened
		}
	else {													// admin is not logged in
		mysql_close ($conn);								// closes connection opened
		header ("Location: index.php");						// return to login page
		}
?>