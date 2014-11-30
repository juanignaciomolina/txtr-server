<?php
	//**GLOBAL VARS**
	$state_dbconn;

	function getDBStatus () {
		return $state_dbconn;
	}

	function saveStatus($dbconnrcv) {
		$state_dbconn = $dbconnrcv;
	}

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

	//INPUT: pincode
	//OUTPUT: return true if the pincode is registered, false otherwise
	function checkExistance ($pincode) {
		//Open MySQL connection to db ejabberd
		include './config/opendbejabberd.php';

		//Query to count how many rows got the same user id as the $pincode, should return 0 or 1
		$query = 	"SELECT ".$dbe_col_user.
					" FROM " .$dbe_tab_users.
					" WHERE ".$dbe_col_user."='".$pincode."'";

		$result = mysqli_query($connDbEjabberd, $query);

		//If num_rows == 0 the $pincode generated is unique in the db
		if (mysqli_num_rows($result) == 0) {
		    $returnCode = false;
		} else {
		    $returnCode = true;
		}

		saveStatus($connDbEjabberd);
		//Close MySQL connection to db ejabberd
		include './config/closedbejabberd.php';

		return $returnCode;
	}

	//INPUT: pincode, password
	//OUTPUT: insert a PIN in the users DB. Returns true if the transaction was OK
	function makePin ($pincode, $password) {
		//Open MySQL connection to db ejabberd
		include './config/opendbejabberd.php';

		$query = 	"INSERT INTO ".$dbe_tab_users.
					" VALUES ('".strtolower($pincode)."', '".$password."', NOW() )";

		if (mysqli_query($connDbEjabberd, $query)) {
		    $returnCode = true;
		} else {
		    $returnCode = false;
		    echo "Error: ". mysqli_error($connDbEjabberd) . "<br>";
		}

		saveStatus($connDbEjabberd);
		//Close MySQL connection to db ejabberd
		include './config/closedbejabberd.php';

		//The result of the query (true, false) is returned
		return $returnCode;
	}

	//INPUT: pincode
	//OUTPUT: delete a PIN from the users DB. Returns true if the transaction was OK
	function deletePin ($pincode) {
		//Open MySQL connection to db ejabberd
		include './config/opendbejabberd.php';

		$query = 	"DELETE FROM ".$dbe_tab_users.
					" WHERE ".$dbe_col_user."='".$pincode."'";

		if (mysqli_query($connDbEjabberd, $query)) {
		    $returnCode = true;
		} else {
		    $returnCode = false;
		}

		saveStatus($connDbEjabberd);
		//Close MySQL connection to db ejabberd
		include './config/closedbejabberd.php';

		//The result of the query (true, false) is returned
		return $returnCode;
	}

	//INPUT: pincode
	//OUTPUT: delete a PIN and its data from EVERY storage. Returns true if the transaction was OK	
	function purgePin ($pincode) {		
		//Method currently not available, using deletePin() instead
		return deletePin($pincode);
	}		

?>