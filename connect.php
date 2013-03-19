<!--
	This file creates a connection to the database 'unoDB'.
	
	$conn holds the connection built using mysql_connect() function
	die() displays the error encoutered while executing the mysql functions or if something fails
-->


<?php
	$conn = mysql_connect ('localhost', 'root', '') or die ('Could not establish a connection.');	// <connection_holder> = mysql_connect('<server>' , '<user>', '<password>')
	mysql_select_db ('unoDB', $conn) or die ('Error in selecting database.');						// mysql_select_db('<DB_name>', <connection_holder>)
?>