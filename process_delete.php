<?php
	session_start ();
	require_once ("connect.php");
	
	if (isset ($_SESSION['username'])) {
		$user = $_SESSION['username'];
		if (isset ($_GET['item'])) {
			$item = $_GET['item'];
			$chance = 2;
			//echo "<script> alert('Are you sure you want to delete this?'); </script>";
			
			mysql_query ("delete from menu where foodcode=\"{$item}\" ") or die ("Unable to delete item. ".mysql_error());
			header ("Location: viewCurrentMenuItems.php");
			}
		}
	
	mysql_close ($conn);
?>