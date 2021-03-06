<?php

	//This is an overloaded function, every argument is optional. If an argmuent is not supplied,
	//the function will use the default values specified
	//Arguments: pinJSON($success, $pincode, $password, $host, $timestamp, $token)
	function pinJSON($state = null, $pincode = null, $password = null, $host = null, $creation = null, $token = null) {
		
		$jsonarray = array(
				"type"=>"pin",					//Type of object: PIN
				"state"=>$state,				//State of the last transaction executed on the object, ie: 0 FALSE, 1 TRUE, 200 ERROR, 201 ERROR TYPE 1
				"pincode"=>$pincode,			//Alphanumeric PIN that identifies this object
				"password"=>$password,			//PIN's password
				"host"=>$host,					//PIN's host, ie: droidko.com
				"creationdate"=>$creation,		//Date of PIN's creation
				"apitime"=>time(),				//API time at the moment of the JSON object creation
				"pintoken"=>$token				//The token is the result of applying a hashing algorithm to the pincode					
				);

		return json_encode($jsonarray);
	}

	//This is an overloaded function, every argument is optional. If an argmuent is not supplied,
	//the function will use the default values specified
	//Arguments: apiJSON($success)
	function apiJSON($state = null) {
		
		$jsonarray = array(
				"type"=>"api",					//Type of object: API
				"state"=>$state,				//State of the last transaction executed on the object, ie: 0 FALSE, 1 TRUE, 200 ERROR, 201 ERROR TYPE 1				
				);

		return json_encode($jsonarray);
	}

?>