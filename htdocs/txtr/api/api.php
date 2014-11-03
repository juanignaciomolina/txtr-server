<?php
	/*	DESCRIPTION: JSON/HTML REST API with numerous methods for working with PINs
		INPUT: method (mandatory string) + others optional arguments
		OUTPUT: HTML / JSON depending on the method specified
		EXAMPLE: api.droidko.com/pin.php?method=pinRegister&pincode=AAABBBC
	*/

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

	function messageHTML($ans, $validMethods = []) {
		switch ($ans) {
			case 1:
				return "API: No method specified, please provide one with GET: ?method=" . implode(" or ",$validMethods) . "<br>";			

			case 2:
				return "API: Invalid method specified, please use one of the following methods: " . implode(", ",$validMethods) . "<br>";
			
			default:
				return "API: Unknown error";
		}
	}

	function messageJSON($ans) {
		include '../utils/jsontools.php';
		switch ($ans) {
			case 1:
				return apiJSON(200); //No method provided		

			case 2:
				return apiJSON(201); //Invalid method provided
			
			default:
				return apiJSON(299); //Unknown error
		}
	}

	//Check how the output is needed, may be plain html or a json object. Default is HTML
	if (isset($_GET["output"])) {
		$output = $_GET["output"];
	}
	else {
		$output = 'html';
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
				if($output == 'html') {echo messageHTML(2, $methods);}
				else {echo messageJSON(2);}
				break;
		}

	}
	else {
		if($output == 'html') {echo messageHTML(1, $methods);}
		else {echo messageJSON(1);}
	}

?>