<!--
	This serves as the processing area.
	This file processes the orders ordered by the user.
-->
<?php
	session_start ();
	require_once ("connect.php");								//connect to database
	
	
	if (!isset ($_SESSION['username'])) {						//checks if the user is logged in
		header ("Location: index.php");
		}
	
	elseif (isset ($_GET['flag']) && $_GET['flag'] == 8) {		//from favorites
		$uname = $_SESSION['username'];	
		$payment = $_GET ['payment'];
		$_SESSION['payment'] = $payment;
		
		//echo $payment;
		
		settype($payment, "integer");
	
		$favcodes = $_SESSION['favcodes'];
		$tot = $_SESSION['favprice'];
		
		//insert to database and update the user's reward points
		mysql_query("insert into orderqueue (customer, foodcodes, total, payment) values (\"{$uname}\", \"{$favcodes}\", {$tot}, {$payment}) ") or die ("Unable to insert items to orderqueue.");
		mysql_query ("update users set rewardpoints={$_SESSION['new_rw']} where username=\"{$_SESSION['username']}\" ");
		mysql_close ($conn);
		header ("Location: orders.php?uname={$_SESSION['username']}&total={$tot}&orderlist={$favcodes}&payment={$payment}&flag=6"); //redirect to orders.php showing the orderlist
		}
		
	elseif (isset ($_GET['pay']) && $_GET['pay'] == 2) {		// from favorites
		$_SESSION['pay'] = $_GET['pay'];
		header ("Location: user.php");
		}
	else {
		$orderlist = $_SESSION['orderlist'];
		$total = $_SESSION['total'];
		$uname = $_SESSION['username'];	
		$payment = $_GET ['payment'];
		$_SESSION['payment'] = $payment;
		
		//echo $payment;
		
		settype($payment, "integer");
		settype($total, "integer");
		
		if (isset ($_GET['x'])) {
			$payment = $total = $_GET['payment'];
			}
		
		if($payment < $total) {
			header ("Location: user.php?set=5"); //if payment is less than total amount, redirect to viewtray.php
			}
			
		else {
			mysql_query("insert into orderqueue (customer,foodcodes,total,payment) values (\"{$uname}\", \"{$orderlist}\", {$total}, {$payment}) ") or die ("Unable to insert items to orderqueue." . mysql_error());
			mysql_query ("update users set rewardpoints={$_SESSION['new_rw']} where username=\"{$uname}\" ") or die ("Unable to insert items to orderqueue." . mysql_error());
			mysql_close ($conn);
			$_SESSION['food'] = 0;		//reset to no food in the tray
			header ("Location: orders.php?uname={$_SESSION['username']}&total={$total}&orderlist={$orderlist}&payment={$payment}&flag=5"); //redirect to orders.php showing the orderlist
			}
		}
?>