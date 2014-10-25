<?php  
	// Connects to 'prosody' database
	$dbprosody = 'prosody';
	
	$connDbProsody = mysql_connect($dbhost, $dbuser, $dbpass) or die ( mysql_error() );  
	mysql_select_db($dbprosody) or die ( mysql_error() );  
?>
