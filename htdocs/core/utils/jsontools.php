<?php

	function pinJSON($success, $pincode, $password) {
		$jsonarray = array(
				"success"=>$success,
				"pin"=>$pincode,
				"password"=>$password
				);
		return json_encode($jsonarray);
	}

?>