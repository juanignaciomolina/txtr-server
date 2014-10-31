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
		include './config/hostconfig.php';

		//Query to count how many rows got the same user id as the $pincode, should return 0 or 1
		$query = "SELECT ".$dbprosody_user.", ".$dbprosody_store.
		" FROM ". $dbprosody_table .
		" WHERE ".$dbprosody_user."=".$pincode." AND ".$dbprosody_store."='accounts'";
		$result = mysqli_query($connDbProsody, $query);

		//If num_rows == 0 the $pincode generated is unique in the db
		if (mysqli_num_rows($result) == 0) {
		    $returnCode = false;
		} else {
		    $returnCode = true;
		}

		//Close MySQL connection to db prosody
		include './config/closedbprosody.php';

		return $returnCode;
	}

	function makePin ($pincode, $password) {
		//Open MySQL connection to db prosody
		include './config/mysqlconfig.php';
		include './config/opendbprosody.php';
		include './config/hostconfig.php';

		$query = "INSERT INTO ".$dbprosody_table.
		" (".$dbprosody_host.", ".$dbprosody_user.", ".$dbprosody_store.", ".$dbprosody_value.")
		VALUES ('".$virtualhost."', '".$pincode."', '".$dbprosody_col_acc."', '".$password."')";

		if (mysqli_query($connDbProsody, $query)) {
		    echo "New record created successfully <br>";
		    $returnCode = true;
		} else {
		    echo "Error: " . $query . "<br>" . mysqli_error($connDbProsody) . "<br>";
		    $returnCode = false;
		}

		//Close MySQL connection to db prosody
		include './config/closedbprosody.php';

		//The result of the query (true, false) is returned
		return $returnCode;
	}	

?>