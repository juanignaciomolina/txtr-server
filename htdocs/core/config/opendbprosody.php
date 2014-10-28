<?php  
	// Connects to 'prosody' database
	$dbprosody = 'prosody';
	
	$connDbProsody = mysql_connect($dbhost, $dbuser, $dbpass) or die ( mysql_error() );  
	mysql_select_db($dbprosody) or die ( mysql_error() );

	//Column names for querys
	$dbprosody_table = 'prosody';
	$dbprosody_host = 'host';
	$dbprosody_user = 'user';
	$dbprosody_store = 'store';
	$dbprosody_key = 'key';
	$dbprosody_type = 'type';
	$dbprosody_value = 'value';
?>
