<!DOCTYPE html>
<html>
	<body>

		<?php

			//pintools.php has some useful tools for generating PINs and passwords
			include 'utils/pintools.php';
			include 'utils/gentools.php';

			//Static
			$MAX_ATTEMPTS = 5;


			$pincode;
			$retry = 0;
			//We are gonna keep generating PINs until we get one that is unique
			do { 
				$pincode = generatePincode();	
				$retry++;
				echo "Attempt ".$retry." of ".$MAX_ATTEMPTS." ...<br>";
			} while ( checkExistance($pincode) and ($retry <= $MAX_ATTEMPTS) );

			//We add some logic to prevent infinit loops
			if ($retry > $MAX_ATTEMPTS) {
				echo "Error: Max attempts reach";
			}
			else {

				$password = generatePassword();

				//Insert the new $pincode in the db
				makePin($pincode, $password);
				
				//Finally, a unique PIN is returned
				echo "PIN: ".$pincode."<br> Password: ".$password;

			}

		?>

	</body>
</html>