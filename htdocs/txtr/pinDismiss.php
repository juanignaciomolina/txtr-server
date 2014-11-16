		<?php

			/*	DESCRIPTION: Try to eliminate a pin of the DB.
				INPUT: pincode (7 chars lowercase string), pintoken (13 chars lowercase string)
				OUTPUT: HTML / JSON response of the deleting operation
				EXAMPLE: /pinDismiss.php?pincode=AAABBBC&pintoken=AAAABBBB12345
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

			//A PINCODE and a PINTOKEN are needed to dismiss a PIN through REST
			if ( isset($_GET["pincode"]) and isset($_GET["pintoken"]) ) {
				$pincode = $_GET["pincode"];
				$pintoken = $_GET["pintoken"];
				tryDismiss($output, $pincode, $pintoken, $pintokenkey, $virtualhost); //$pintokenkey and virtualhost provided in hostconfig.php
			}
			elseif (!isset($_GET["pincode"])) {
				if ($output == 'html') { echo "Error: No PINCODE provided.<br> Send a PINCODE with GET method: pinDismiss.php?pincode=pinToDismiss"; }
				elseif ($output == 'json') { echo pinJSON(200); }
			}
			//A Token is needed to verify that the pincode was provided by the API
			elseif (!isset($_GET["pintoken"])) {
				if ($output == 'html') { echo "Error: No PINTOKEN provided.<br> Send a PINTOKEN with GET method: pinDismiss.php?pincode=pinTokenAuth"; }
				elseif ($output == 'json') { echo pinJSON(201); }
			}

			function tryDismiss($output, $pincode, $pintoken, $pintokenkey, $virtualhost) {


				if ($pintoken !== generateToken($pincode, $pintokenkey)) {
					if ($output == 'html') { echo "Error: invalid PINTOKEN<br>"; }
					elseif ($output == 'json') { echo pinJSON(202); }
				}
				//We need to check if the PIN provided is already registerd
				elseif ( !checkExistance($pincode) ) {
					if ($output == 'html') { echo "Error: PINCODE not found<br>"; }
					elseif ($output == 'json') { echo pinJSON(203); }
				}
				else {

					//Delete the $pincode from the DB
					if ( purgePin($pincode) ) {
						//Finally, a unique PIN and it's password is returned
						if ($output == 'html') { 
							echo "Pin dismissed successfully <br>";
							echo "PIN: ".$pincode."<br>";
							echo "Token: ".$pintoken. "<br>";
							echo "Host: ".$virtualhost. "<br>";
						}
						elseif ($output == 'json') { echo pinJSON(1, $pincode, null, $virtualhost, null, $pintoken); }
					}
					else {
						//If there was a problem registering the PIN we return a failed state
						if ($output == 'html') { echo "Error: ". mysqli_error($connDbProsody) . "<br>"; }
						elseif ($output == 'json') { echo pinJSON(204); }
					}
					
				}

			}

		?>