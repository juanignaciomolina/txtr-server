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

			//Check how the output is needed, may be plain html or a json object. Default is HTML
			if (isset($_GET["output"])) {
				$output = $_GET["output"];
			}
			else {
				$output = 'html';
			}

			//A PIN is needed to register a PIN through REST
			if (isset($_GET["pincode"])) {
				$pincode = $_GET["pincode"];
				tryRegister($output, $pincode);
			}
			else {
				if ($output == 'html') { echo "Error: No PIN provided.<br> Send a PIN with GET method: pinRegister.php?pincode=pinToRegister"; }
				elseif ($output == 'json') { echo pinJSON(false, null, null); }
			}

			function tryRegister($output, $pincode) {

				//We need to check if the PIN provided is already registerd
				if ( checkExistance($pincode) ) {
					if ($output == 'html') { echo "Error: PIN already registered<br>"; }
					elseif ($output == 'json') { echo pinJSON(false, null, null); }
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
						elseif ($output == 'json') { echo pinJSON(true, $pincode, $password); }
					}
					else {
						//If there was a problem registering the PIN we return a failed state
						if ($output == 'html') { echo "Error: ". mysqli_error($connDbProsody) . "<br>"; }
						elseif ($output == 'json') { echo pinJSON(false, null, null); }
					}
					
				}

			}

		?>