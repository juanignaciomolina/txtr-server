<!DOCTYPE html>
<html>
	<body>

		<?php

			//pintools.php has some useful tools for generating PINs and passwords
			include 'utils/pintools.php';
			include 'utils/gentools.php';

			//Static
			$MAX_ATTEMPTS = 5;

			//Check how the output is needed, may be plain html or a json object. Default is HTML
			if (isset($_GET["output"])) {
				$output = $_GET["output"];
			}
			else {
				$output = 'html';
			}

			$pincode;
			$retry = 0;
			//We are gonna keep generating PINs until we get one that is unique
			do { 
				$pincode = generatePincode();	
				$retry++;
				if ($output == 'html') { echo "Attempt ".$retry." of ".$MAX_ATTEMPTS." ...<br>"; };
			} while ( checkExistance($pincode) and ($retry <= $MAX_ATTEMPTS) );

			//We add some logic to prevent infinit loops
			if ($retry > $MAX_ATTEMPTS) {
				if ($output == 'html') { echo "Error: Max attempts reach"; };
			}
			else {

				$password = generatePassword();

				//Insert the new $pincode in the db
				if ( makePin($pincode, $password) ) {
					if ($output == 'html') { 
						echo "New record created successfully <br>";
						//Finally, a unique PIN is returned
						echo "PIN: ".$pincode."<br> Password: ".$password;
					};
					if ($output == 'json') {
						$jsonarray = array("success"=>true,"pin"=>$pincode, "password"=>$password);
						echo json_encode($jsonarray);
					}
				}
				else {
					if ($output == 'html') { echo "Error: ". mysqli_error($connDbProsody) . "<br>"; };
					if ($output == 'json') {
						$jsonarray = array("success"=>false,"pin"=>null, "password"=>null);
						echo json_encode($jsonarray);
					}
				}
				
			}

		?>

	</body>
</html>