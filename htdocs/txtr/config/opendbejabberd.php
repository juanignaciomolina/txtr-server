<?php  
	//Includes MySQL auth
	include 'mysqlconfig.php';
	//**Databases**
	$dbejabberd = 'ejabberd';
	//**Tables**
	$dbe_tab_users = 'users';
	//**Columns**
	$dbe_col_user = 'username';
	$dbe_col_pass = 'password';
	$dbe_col_created = 'created_at';
	
	// Create connection
	$connDbEjabberd = mysqli_connect($dbhost, $dbuser, $dbpass, $dbejabberd);
	// Check connection
	if (!$connDbEjabberd) {
	    die("Connection failed: " . mysqli_connect_error());
	}

?>
