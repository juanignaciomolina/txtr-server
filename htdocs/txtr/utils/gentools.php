<?php

	function generatePassword () {
	//Generate random 8 chars (A-Z, a-z, 0-9) password
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

?>