<!--
	This serves as the processing area.
	This file processes the logging in of users/admin in the site.
-->
<?php
	session_start();
	require_once ("connect.php");
	
	if(!isset ($_SESSION['username']) )	header("Location: index.php");	// redirect to main page if not logged in

	$flag = $_GET['flag'];
	
	if ($flag == 1) {
		$foodcode = $_GET['item'];										// get the value of the item passed before redirected to this page (remove from tray)
		$freebie = $_GET['freebie'];
		
		for($i = 0; $i < $_SESSION['foodcount']; $i += 1){
			if(isset($_SESSION['tray'][$i])){
				if($foodcode === $_SESSION['tray'][$i][0]){ 			// if the passed value is the same with the value in the tray,
					if ($freebie == 0) {	// freebie
						$_SESSION['new_rw'] = $_SESSION['new_rw'] + $_SESSION['tray'][$i][2];
						unset($_SESSION['tray'][$i]);						// it is unset. (unset = removed or deallocation)
						break;												// interrupt execution
						}
					else {					// normal product
						unset($_SESSION['tray'][$i]);						// it is unset. (unset = removed or deallocation)
						break;												// interrupt execution
						}
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
		header("Location: user.php");									// redirection making view to stay in tray.php
		}
	
	if ($flag == 2) {
		$foodcode = $_GET['item'];										// get the value of the item passed before redirected to this page (remove fav item)
		for($i = 0; $i < $_SESSION['favcount']; $i += 1){
			if(isset($_SESSION['favorites'][$i])){
				if($foodcode === $_SESSION['favorites'][$i][0]){		// if the passed value is the same with the value in the tray,
					unset($_SESSION['favorites'][$i]);					// it is unset. (unset = removed or deallocation)
					break;												// interrupt execution
					}
				}
			}
		
		for($i = 0; $i < $_SESSION['favcount']; $i += 1){
			if($_SESSION['favorites'] == 1){								// if there's only one value in the tray,
				unset($_SESSION['favorites']);								// deallocate the element of the array
				$_SESSION['favorites'] = array();							// resets the tray to be an empty array
				break;
				}
				
			if(!isset($_SESSION['favorites'][$i])){							// if there's no value in a particular index
				for($j = $i; $j <= ($_SESSION['favcount']-$i); $j += 1){	
					$_SESSION['favorites'][$j] = $_SESSION['favorites'][$j+1];	// assign the element next to the current to be the current value
					}
				
				unset($_SESSION['favorites'][$j]);							// deallocate the element of the array
				break;
				}
			}
		
		$_SESSION['fav'] -= 1;												// decrement food count
		$_SESSION['favcount'] -= 1;
		header("Location: favorites.php");									// redirection making view to stay in tray.php
		}
		
	if ($flag == 3) {	// delete from table favorites
		$item = $_GET['favcodes'];
		mysql_query ("delete from favorites where favcodes=\"{$item}\" ") or die ("Unable to delete from favorites." . mysql_error());
		mysql_close ($conn);
		header("Location: viewFavorites.php");									// redirection making view to stay in tray.php
		}
?>