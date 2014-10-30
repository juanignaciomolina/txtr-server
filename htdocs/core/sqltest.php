<!DOCTYPE html>
<html>
	<body>

		<?php

			// Virtual host config
			$virtualhost = 'droidko.com';
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
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbprosody);
			// Check connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "SELECT ".$dbprosody_user.", ".$dbprosody_store.", ".$dbprosody_value." FROM ". $dbprosody_table ."";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			        echo "user: " . $row["user"]. " - store: " . $row["store"]. " - value: " . $row["value"].   "<br>";
			    }
			} else {
			    echo "0 results";
			}

			/*$sql = "INSERT INTO prosody (host, user)
			VALUES ('TEST.COM', 'TEST')";

			if (mysqli_query($conn, $sql)) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}*/

			mysqli_close($conn);
		?>

	</body>
</html>