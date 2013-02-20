<?php
  session_start();
	require_once ("connect.php");
	
	if (!isset ($_SESSION['username'])) header ("Location: index.php");
	
	$foodcode = $_GET['item'];
	echo $foodcode;
	
	$result = mysql_query ("select * from menu where foodcode=\"{$foodcode}\"; ") or die ("Unable to retrieve items from table.");
	print_r ($result);
	
	$item = mysql_fetch_array ($result);	/* table menu: [0]=<foodcode> [1]=<fooddescription> [2]=<price> [3]=<available> */
	
	settype ($item[2], "float");
	$array = array ($item[0], $item[1], $item[2], $item[3]);
	
	$_SESSION['tray'][] = $array;
	$_SESSION['foodcount'] += 1;
	$_SESSION['food'] += 1;
	
	mysql_close ($conn);
	header("Location: user.php");	// redirects to the users.php
	
	
?>
