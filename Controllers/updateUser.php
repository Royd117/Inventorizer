<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and user model
include "../resources/config/dbcomm.php";
include "../Models/user.php";

session_start();

$database = new Dbcomm();
$db = $database->getConnection();

$user = new User($db);

if(isset($_GET['id']) && isset($_GET['username']) && isset($_GET['displayname']) && isset($_GET['email'])) {
	$data['id'] = $_GET['id'];
	$data['username'] = $_GET['username'];
	$data['email'] = $_GET['email'];
	$data['displayname'] = $_GET['displayname'];
	$change = 0;
}
else if(isset($_GET['id']) && isset($_GET['new'])) {
	$data['id'] = $_GET['id'];
	$data['new'] = $_GET['new'];
	$change = 1;
}
else {
	echo "<script>window.location='/Inventorizer/userSettings'</script>";
}

//$data = json_decode(file_get_contents("php://input"));

if(!empty($data['id'])) {
	
	if($change == 0) {
		$user->id = $data['id'];
		$user->username = $data['username'];
		$_SESSION['username'] = $data['username'];
		$user->email = $data['email'];
		$_SESSION['emailreg'] = $data['email'];
		$user->displayname = $data['displayname'];
		$_SESSION['displayid'] = $data['displayname'];
		$user->password = $_SESSION['ciphpass'];
	}
	else {
		$user->id = $data['id'];
		$user->username = $_SESSION['username'];
		$user->email = $_SESSION['emailreg'];
		$user->displayname = $_SESSION['displayid'];
		$user->password = $data['new'];
		$_SESSION['ciphpass'] = $data['new'];
	}

	if($user->update()) {
		// response 202 - Accepted
		http_response_code(202);
		// message for user
		//echo json_encode(array("log" => "The requested user was updated! :^)"));
		echo "<script>window.location='/Inventorizer/userSettings'</script>";
	}
	else {
		// response 404 - Not Found
		http_response_code(404);
		// message for user
		//echo json_encode(array("log" => "ID not recognized for update! :^("));
		echo "<script>window.location='/Inventorizer/userSettings'</script>";
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	//echo json_encode(array("log" => "Invalid ID entry to fulfill the service. :^("));
	echo "<script>window.location='/Inventorizer/userSettings'</script>";
}

?>