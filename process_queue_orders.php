<?php
  session_start ();
	require_once ("connect.php");
	
	$uname = $_GET['uname'];
	$total = $_GET['total'];
	$order = htmlspecialchars ($_GET['order']);
	
	$count = $_SESSION['foodcount'];
	$token = array();
	$i = 1;
	settype ($order, "string");
	
	//print_r ($order);
	if (!isset ($_SESSION['username'])) {
		header ("Location: index.php");
		}
		
	mysql_query ("insert into orderqueue(customer, foodcodes, total) values customer=\"{$uname}\", foodcodes=\"{$order}\", total={$total}; ") or die ("Unable to queue order." . mysql_error() );
	
	$_SESSION['foodcount'] = 0;
	$_SESSION['food'] = 0;
	$_SESSION['tray'] = array();
	
	mysql_close ($conn);
	header ("Location: user.php?set=8");
?>
