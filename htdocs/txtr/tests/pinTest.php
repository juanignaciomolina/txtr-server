<?php
	/*	DESCRIPTION: Automatic test for PINs methods
		INPUT: test number
		OUTPUT: HTML / JSON depending on the test number specified
		EXAMPLE: api.droidko.com/tests/pinTest.php?test=1
	*/

	//Static
	$tests = array(1);

	//GET and POST variables recieved through HTTP REST
	$vars = $_SERVER['QUERY_STRING'];

	//Status Code 303: "See Other"
	function redirect($url, $statusCode = 303) {
	   header('Location: ../' . $url, true, $statusCode);
	   die();
	}

	function messageHTML($ans, $validTests = []) {
		switch ($ans) {
			case 1:
				return "PIN TEST: No test number specified, please provide one with GET: ?test=" . implode(" or ",$validTests) . "<br>";

			case 2:
				return "PIN TEST: Invalid test number specified,  please use one of the following tests " . implode(", ",$validTests) . "<br>";			
			
			default:
				return "PIN TEST: Unknown error";
		}
	}

	//TODO: create a testJSON type of object
	function messageJSON($ans) {
		include '../utils/jsontools.php';
		switch ($ans) {
			case 1:
				return pinJSON(200); //No test number provided
			
			default:
				return pinJSON(299); //Unknown error
		}
	}

	//Check the method variable to determine where to redirect the request
	if (isset($_GET["test"])) {
		
		switch ($_GET["test"]) {
			case 1:
				redirect("pinRequest.php?".$vars);
				break;
			
			default: //HTML
				echo messageHTML(2, $tests);
				break;
		}

	}
	else {
		echo messageHTML(1, $tests);
	}

?>