<!DOCTYPE html>
<html>
	<body>

		<?php

			//pintools.php has some useful tools for generating PINs and passwords
			include 'utils/pintools.php';
			include 'utils/gentools.php';

			$pincode;
			//We are gonna keep generating PINs until we get one that is unique
			do { 
				$pincode = generatePincode();	
			} while ( checkExistance($pincode) );

			$password = generatePassword();

			//Insert the new $pincode in the db
			makePin($pincode, $password);
			
			//Finally, a unique PIN is returned
			echo "PIN: ".$pincode."<br> Password: ".$password;
		?>

	</body>
</html>