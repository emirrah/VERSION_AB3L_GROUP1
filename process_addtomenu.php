<?php
	session_start ();
	require_once ("connect.php");
	
	$foodcode = htmlspecialchars ($_POST['foodcode']);
	$foodname = htmlspecialchars ($_POST['foodname']);
	$price = htmlspecialchars ($_POST['price']);
	$available = htmlspecialchars ($_POST['available']);
	$flag = 0;
	
	$codes = mysql_query ("select foodcode from menu;");
	
	
	while ($c = mysql_fetch_array ($codes)) {
		if ($c[0] === $foodcode) {
			$flag = 1;
			break;
			}
		}
	
	if ($flag == 0) {
		mysql_query ("insert into menu values (\"{$foodcode}\", \"{$foodname}\", {$price}, {$available}) ") or die ("Unable to insert to table menu.");
		mysql_close ($conn);
		header ("Location: addFoodItems.php");
		}
	else {
		header ("Location: addFoodItems.php?set=1");
		}

?>