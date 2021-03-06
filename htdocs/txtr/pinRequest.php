<?php

			/*	DESCRIPTION: Generates a unique PIN (uniqueness validated with the DB)
				INPUT: none
				OUTPUT: HTML / JSON of a unique PIN
				EXAMPLE: /pinRequest.php
			*/

			//pintools.php has some useful tools for generating PINs
			include 'utils/pintools.php';
			include 'utils/jsontools.php';
			include 'utils/gentools.php';
			include 'config/hostconfig.php'; //The file has the $pintokenkey value

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
			//We add some logic to prevent infinit loops
			} while ( checkExistance($pincode) and ($retry <= $MAX_ATTEMPTS) );

			if ($retry > $MAX_ATTEMPTS) {
				if ($output == 'html') { echo "Error: Max attempts reach"; }
				elseif ($output == 'json') { echo pinJSON(200); }
			}
			else {
				//Finally, a unique PIN is returned with it's auth token
				$pintoken = generateToken($pincode, $pintokenkey);
				if ($output == 'html') { 
					echo "Unique PIN found<br>";
					echo "PIN CODE: ".$pincode."<br>";
					echo "PIN TOKEN: ".$pintoken;
				};
				if ($output == 'json') { echo pinJSON(1, $pincode, null, null, null, $pintoken); }				
			}

		?>