<?php
	//Static
	$methods = array(
				"pinRequest",
				"pinRegister");

	//GET and POST variables recieved through HTTP REST
	$vars = $_SERVER['QUERY_STRING'];

	//Status Code 303: "See Other"
	function redirect($url, $statusCode = 303) {
	   header('Location: ../' . $url, true, $statusCode);
	   die();
	}

	function message($ans, $validMethods = []) {
		switch ($ans) {
			case 1:
				return "API: No method specified, please provide one with GET: ?method=" . implode(" or ",$validMethods) . "<br>";			

			case 2:
				return "API: Invalid method specified, please use one of the following methods: " . implode(", ",$validMethods) . "<br>";
			
			default:
				return "API: Unknown error";
		}
	}

	//Check the method variable to determine where to redirect the request
	if (isset($_GET["method"])) {
		
		switch ($_GET["method"]) {
			case 'pinRequest':
				redirect("pinRequest.php?".$vars);
				break;

			case 'pinRegister':
				redirect("pinRegister.php?".$vars);
				break;
			
			default:
				echo message(2, $methods);
				break;
		}

	}
	else {
		echo message(1, $methods);
	}

?>