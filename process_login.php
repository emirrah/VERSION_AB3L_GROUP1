<?php
	session_start();
	$user = htmlspecialchars($_POST['username']);
	$pw = $_POST['pw'];
	$pw1 = md5($_POST['pw']);
	
	if ($user.strtolower() === "admin" && $pw.strtolower() === "admin"){
		$_SESSION['username'] = $user;
		header ("Location: admin.php");
		}
		
	else {
		require_once ("connect.php");
		$accounts = mysql_query ("select * from users");
		$flag = 0;
		$i = 0;
		while ($users = mysql_fetch_array ($accounts)) {
			if ($users[0] === $user && $users[1] === $pw1) {
				$_SESSION['username'] = $user;
				$flag = 1;
				mysql_close ($conn);
				header ("Location: user.php");
				}
			$i += 1;
			}
		
		if ($flag === 0) {
			mysql_close ($conn);
			header ("Location: index.php?set=1");
			}
		}
?>