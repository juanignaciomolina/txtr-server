		<?php

			/*	DESCRIPTION: Try to insert a pincode and a generic password in the DB.
				INPUT: pincode (7 chars lowercase string)
				OUTPUT: HTML / JSON of a unique PIN with it's password
				EXAMPLE: /pinRegister.php?pincode=AAABBBC
			*/

			//pintools.php has some useful tools for generating PINs and passwords
			include 'utils/pintools.php';
			include 'utils/gentools.php';
			include 'utils/jsontools.php';
			include 'config/hostconfig.php'; //The file has the $pintokenkey and $virtualhost values

			//Check how the output is needed, may be plain html or a json object. Default is HTML
			if (isset($_GET["output"])) {
				$output = $_GET["output"];
			}
			else {
				$output = 'html';
			}

			//A PINCODE and a PINTOKEN are needed to register a PIN through REST
			if ( isset($_GET["pincode"]) and isset($_GET["pintoken"]) ) {
				$pincode = $_GET["pincode"];
				$pintoken = $_GET["pintoken"];
				tryRegister($output, $pincode, $pintoken, $pintokenkey, $virtualhost);
			}
			elseif (!isset($_GET["pincode"])) {
				if ($output == 'html') { echo "Error: No PINCODE provided.<br> Send a PINCODE with GET method: pinRegister.php?pincode=pinToRegister"; }
				elseif ($output == 'json') { echo pinJSON(200); }
			}
			//A Token is needed to verify that the pincode was provided by the API
			elseif (!isset($_GET["pintoken"])) {
				if ($output == 'html') { echo "Error: No PINTOKEN provided.<br> Send a PINTOKEN with GET method: pinRegister.php?pincode=pinTokenAuth"; }
				elseif ($output == 'json') { echo pinJSON(201); }
			}

			function tryRegister($output, $pincode, $pintoken, $pintokenkey, $virtualhost) {


				if ($pintoken !== generateToken($pincode, $pintokenkey)) {
					if ($output == 'html') { echo "Error: invalid PINTOKEN<br>"; }
					elseif ($output == 'json') { echo pinJSON(202); }
				}
				//We need to check if the PIN provided is already registerd
				elseif ( checkExistance($pincode) ) {
					if ($output == 'html') { echo "Error: PINCODE already registered<br>"; }
					elseif ($output == 'json') { echo pinJSON(203); }
				}
				else {

					//New random password for the PIN
					$password = generatePassword();

					//Insert the new $pincode in the db
					if ( makePin($pincode, $password) ) {
						//Finally, a unique PIN and it's password is returned
						if ($output == 'html') { 
							echo "New record created successfully <br>";
							echo "PIN: ".$pincode."<br> Password: ".$password;
						}
						elseif ($output == 'json') { echo pinJSON(1, $pincode, $password, $virtualhost, null, $pintoken); }
					}
					else {
						//If there was a problem registering the PIN we return a failed state
						if ($output == 'html') { echo "Error: ". mysqli_error($connDbProsody) . "<br>"; }
						elseif ($output == 'json') { echo pinJSON(204); }
					}
					
				}

			}

		?>