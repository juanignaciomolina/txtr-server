<?php  
	// Connects to 'prosody' database
	$dbprosody = 'prosody';
	// MySQL user config
	$dbhost = 'localhost';
	$dbuser = 'txtrCore';
	$dbpass = 'd5rxTGB2Rr3eHx73';
	//Column names for querys
	$dbprosody_table = 'prosody';
	$dbprosody_host = 'host';
	$dbprosody_user = 'user';
	$dbprosody_store = 'store';
	$dbprosody_key = 'key';
	$dbprosody_type = 'type';
	$dbprosody_value = 'value';
	
	// Create connection
	$connDbProsody = mysqli_connect($dbhost, $dbuser, $dbpass, $dbprosody);
	// Check connection
	if (!$connDbProsody) {
	    die("Connection failed: " . mysqli_connect_error());
	}

?>
