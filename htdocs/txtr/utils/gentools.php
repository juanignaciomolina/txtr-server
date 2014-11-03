<?php

	//Generate random 8 chars (A-Z, a-z, 0-9) password
	function generatePassword () {
		$alphabet = array_merge(range('A', 'Z'), range('a','z'), range(0, 9));
		$password =	$alphabet[rand(0,61)].
					$alphabet[rand(0,61)].
					$alphabet[rand(0,61)].
					$alphabet[rand(0,61)].
					$alphabet[rand(0,61)].
					$alphabet[rand(0,61)].
					$alphabet[rand(0,61)].
					$alphabet[rand(0,61)];
		return $password;
	}

	//Generate auth token for PINs creation
	function generatePinToken ($pincode) {
		include './config/hostconfig.php'; //The file has the $pintokenkey value
		return crypt($pincode, $pintokenkey); //crypt(stringToEncrypt, key)
	}

?>