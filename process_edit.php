<?php
	session_start ();
	require_once ("connect.php");
	
	if (isset ($_SESSION['username'])) {
		$user = $_SESSION['username'];
		if (isset ($_GET['item'])) {
			$item = $_GET['item'];
			$newCode = $_POST['newFoodCode'];
			$newFoodName = $_POST['newFoodName'];
			$newprice = $_POST['newPrice'];
			$available = $_POST['available'];
			
			mysql_query ("update menu set foodcode=\"{$newCode}\", foodname=\"{$newFoodName}\", price={$newprice}, available={$available} where foodcode=\"{$item}\"") or die ("Unable to update item. ".mysql_error());
			mysql_close ($conn);
			header ("Location: viewCurrentMenuItems.php");
			}
		}
		
	else {
		mysql_close ($conn);
		header ("Location: index.php");
		}
?>