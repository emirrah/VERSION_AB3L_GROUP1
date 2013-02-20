<?php
  session_start();
	
	if(!isset ($_SESSION['username']) )	header("Location: index.php");

	$foodcode = $_GET['item'];										// get the value of the item passed before redirected to this page
	
	for($i = 0; $i < $_SESSION['foodcount']; $i += 1){
		if(isset($_SESSION['tray'][$i])){
			if($foodcode === $_SESSION['tray'][$i][0]){				// if the passed value is the same with the value in the tray,
				unset($_SESSION['tray'][$i]);						// 		it is unset. (unset = removed or deallocation)
				break;												// interrupt execution
				}
			}
		}
	
	for($i = 0; $i < $_SESSION['foodcount']; $i += 1){
		if($_SESSION['tray'] == 1){									// if there's only one value in the tray,
			unset($_SESSION['tray']);								// deallocate the element of the array
			$_SESSION['tray'] = array();							// resets the tray to be an empty array
			break;
			}
			
		if(!isset($_SESSION['tray'][$i])){							// if there's no value in a particular index
			for($j = $i; $j <= ($_SESSION['foodcount']-$i); $j += 1){	
				$_SESSION['tray'][$j] = $_SESSION['tray'][$j+1];	// assign the element next to the current to be the current value
				}
			
			unset($_SESSION['tray'][$j]);							// deallocate the element of the array
			break;
			}
		}
	
	$_SESSION['food'] -= 1;											// decrement food count
	$_SESSION['foodcount'] -= 1;
	header("Location: viewtray.php");									// redirection making view to stay in tray.php

?>
