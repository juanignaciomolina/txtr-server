<!DOCTYPE html>
<html>
	<body>

		<?php
			//Random 7 chars (A-Z,0-9) PIN
			$alphabet = array_merge(range('A', 'Z'), range(0, 9));
			$pincode = 	$alphabet[rand(0,35)].
						$alphabet[rand(0,35)].
						$alphabet[rand(0,35)].
						$alphabet[rand(0,35)].
						$alphabet[rand(0,35)].
						$alphabet[rand(0,35)].
						$alphabet[rand(0,35)];
			echo $pincode;
		?>

	</body>
</html>