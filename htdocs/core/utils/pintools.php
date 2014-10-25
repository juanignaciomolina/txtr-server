<?php

	function generatePincode () {
	//Generate random 7 chars (A-Z,0-9) PIN
	$alphabet = array_merge(range('A', 'Z'), range(0, 9));
	$pincode = 	$alphabet[rand(0,35)].
				$alphabet[rand(0,35)].
				$alphabet[rand(0,35)].
				$alphabet[rand(0,35)].
				$alphabet[rand(0,35)].
				$alphabet[rand(0,35)].
				$alphabet[rand(0,35)];
	return $pincode;
	}

	function checkExistance ($pincode) {
		//Open MySQL connection to db prosody
		include './config/mysqlconfig.php';
		include './config/opendbprosody.php';

		//Query to count how many rows got the same user id as the $pincode, should return 0 or 1
		$query = "SELECT * FROM prosody WHERE user='$pincode' AND store='accounts'";
		$result = MySQL_query($query);
		$nrows = mysql_num_rows($result);
		//If $nrows == 0 the $pincode generated is unique in the db
		if ($nrows == 0) {
			$returnCode = false;
		} else {
			$returnCode = true;
		}

		//Close MySQL connection to db prosody
		include './config/closedbprosody.php';

		return $returnCode;
	}

?>