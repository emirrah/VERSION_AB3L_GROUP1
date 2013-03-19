<!--
	This serves as the processing area.
	This file processes the removal of food item in the database (table 'orderqueue').
-->

<?php
	session_start ();										// starts a session
	require_once ("connect.php");							// build a connection to the database
	
	if (isset ($_SESSION['username'])) {					// if admin is logged in
		$user = $_SESSION['username'];
		if (isset ($_GET['item'])) {						// if the order_number is passed from 'viewOrderList.php' link "Remove"
			$item = $_GET['item'];							// store order_number passed in $item
				
				/* the next line deletes the ordered item given the order_number specified by the admin; displays an error message if delete operation fails */
			mysql_query ("delete from orderqueue where order_number=\"{$item}\" ") or die ("Unable to delete item. ".mysql_error());
			header ("Location: viewOrderList.php");			// redirects to viewOrderList.php to view the changes
			}
		mysql_close ($conn);								// closes connection opened
		}
	else {													// admin is not logged in
		mysql_close ($conn);								// closes connection opened
		header ("Location: index.php");						// return to login page
		}
?>