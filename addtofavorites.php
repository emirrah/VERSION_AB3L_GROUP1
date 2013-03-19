<!--
	This pages adds the selected food items to favorites in the database.
-->
<?php
	session_start();
	require_once ("connect.php");		//connect to database
	
	$flag = $_GET['flag'];
	
	if ($flag == 1) {
		if (!isset ($_SESSION['username'])) header ("Location: index.php");		//redirect to main page if not logged in
		
		$foodcode = $_GET['item'];
		echo $foodcode;
		
		$result = mysql_query ("select * from menu where foodcode=\"{$foodcode}\"; ") or die ("Unable to retrieve items from table.");
		print_r ($result);
		
		$item = mysql_fetch_array ($result);	/* table menu: [0]=<foodcode> [1]=<fooddescription> [2]=<price> [3]=<available> */
		
		settype ($item[2], "float");
		$array = array ($item[0], $item[1], $item[2], $item[3]);
		
		$_SESSION['favorites'][] = $array;
		$_SESSION['favcount'] += 1;
		$_SESSION['fav'] += 1;
		
		mysql_close ($conn);
		header("Location: favorites.php");	// redirects to the users.php
		}
		
	if ($flag == 2) {						// add to favorites table
		$orderlist = $_GET['orderlist'];
		
		mysql_query("insert into favorites (customer, favcodes, price) values (\"{$_SESSION['username']}\", \"{$orderlist}\", {$_GET['price']}) ") or die ("Unable to insert items to favorites." . mysql_error());
		mysql_close ($conn);
		$_SESSION['fav'] = 0;				//reset to no food in the tray
		$_SESSION['favorites'] = array();
		$_SESSION['favcount'] = 0;
		
		header ("Location: favorites.php?error=1");
		}
?>