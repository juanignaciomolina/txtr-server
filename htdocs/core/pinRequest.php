<!DOCTYPE html>
<html>
	<body>

		<?php

			//pintools.php has some useful tools for generating PINs
			include 'utils/pintools.php';

			$pincode;
			//We are gonna keep generating PINs until we get one that is unique
			do { 
				$pincode = generatePincode();	
			} while ( checkExistance($pincode) );
			
			//Finally, a unique PIN is returned
			echo $pincode;
		?>

	</body>
</html>