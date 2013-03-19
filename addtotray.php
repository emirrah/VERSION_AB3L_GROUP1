<!--
	This pages adds the selected food items to the virtual tray.
-->
<?php
	session_start();
	require_once ("connect.php");											//connect to database
	
	if (!isset ($_SESSION['username'])) header ("Location: index.php");		//redirect to main page if not logged in
	
	if (isset ($_GET['flag']) && $_GET['flag'] == 2) {						//from favorites
		$foodcode = $_GET['favcodes'];
		$str = "";
		$error = 0;

		$str = strtok ($foodcode, " ");
		
		while ($str != false) {
			$result = mysql_query ("select * from menu where foodcode=\"{$str}\"; ") or die ("Unable to retrieve items from table menu." . mysql_error());
			
			$item = mysql_fetch_array ($result);	/* table menu: [0]=<foodcode> [1]=<fooddescription> [2]=<price> [3]=<available> */
			$str = strtok (" ");
			
			if ($item[3] == 1) {
				settype ($item[2], "float");
				$array = array ($item[0], $item[1], $item[2], $item[3], 1);
				
				$_SESSION['tray'][] = $array;
				$_SESSION['foodcount'] += 1;
				$_SESSION['food'] += 1;
				}
			else $error = 1;
			}
		
		if ($error == 1){
			mysql_close ($conn);
			header("Location: user.php?set=3");	// redirects to the user.php
			}
		else {
			mysql_close ($conn);
			header("Location: user.php");		// redirects to the user.php
			}
		}
		
	else if (isset ($_GET['flag']) && $_GET['flag'] == 3) {			// from userMenu
		$foodcode = $_GET['item'];
		echo $foodcode;
		
		$result = mysql_query ("select * from menu where foodcode=\"{$foodcode}\"; ") or die ("Unable to retrieve items from table.");
		print_r ($result);
		
		$item = mysql_fetch_array ($result);	/* table menu: [0]=<foodcode> [1]=<fooddescription> [2]=<price> [3]=<available> */
		
		settype ($item[2], "float");
		$array = array ($item[0], $item[1], $item[2], $item[3], 1);
		
		$_SESSION['tray'][] = $array;
		$_SESSION['foodcount'] += 1;
		$_SESSION['food'] += 1;
		
		mysql_close ($conn);
		header("Location: user.php");	// redirects to the users.php
		}
		
	else if (isset ($_GET['rew_pt']) && isset ($_GET['flag']) && $_GET['flag'] == 4) {		// for freebie
		$foodcode = $_GET['item'];
		$rew_pt = $_GET['rew_pt'];
		
		
		$result = mysql_query ("select * from menu where foodcode=\"{$foodcode}\"; ") or die ("Unable to retrieve items from table.");
		
		$item = mysql_fetch_array ($result);	/* table menu: [0]=<foodcode> [1]=<fooddescription> [2]=<price> [3]=<available> */
		
		settype ($item[2], "float");
		$item[0] = $item[0] . "_freebie";
		
		$array = array ($item[0], $item[1], $item[2], $item[3], 0);
		
		$_SESSION['tray'][] = $array;
		$_SESSION['foodcount'] += 1;
		$_SESSION['food'] += 1;
		
		// update reward points
		$new_rw = $rew_pt - $item[2];
		$_SESSION['new_rw'] = $new_rw;
		
		
		mysql_close ($conn);
		header("Location: user.php");	// redirects to the users.php
		}
?>