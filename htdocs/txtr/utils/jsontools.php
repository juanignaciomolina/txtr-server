<?php

	//This is an overloaded function, every argument is optional. If an argmuent is not supplied,
	//the function will use the default values specified
	//Arguments: pinJSON($success, $pincode, $password, $host, $timestamp, $token)
	function pinJSON($state = null, $pincode = null, $password = null, $host = null, $timestamp = null, $token = null) {
		
		$jsonarray = array(
				"type"=>"pin",					//Type of object: PIN
				"state"=>$state,				//State of the last transaction executed on the object, ie: 0 FALSE, 1 TRUE, 200 ERROR, 201 ERROR TYPE 1
				"pincode"=>$pincode,			//Alphanumeric PIN that identifies this object
				"password"=>$password,			//PIN's password
				"host"=>$host,					//PIN's host, ie: droidko.com
				"timestamp"=>$timestamp,		//Date of PIN's creation
				"token"=>$token					//The token is the result of applying a hashing algorithm to the pincode					
				);

		return json_encode($jsonarray);
	}

?>