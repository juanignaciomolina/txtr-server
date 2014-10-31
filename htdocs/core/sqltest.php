<!DOCTYPE html>
<html>
	<body>

		<?php
			//pintools.php has some useful tools for generating PINs and passwords
			include 'utils/pintools.php';
			include 'utils/gentools.php';

			$pincode = 'emma';
			purgePin($pincode);

		?>

	</body>
</html>