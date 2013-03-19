<?php
	session_start();					// starts a seesion
	session_destroy();					// destroy/closes the session
	header ("Location: index.php");		// redirect to login/main page (index.php)
?>