<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and user model
include "../resources/config/dbcomm.php";
include "../Models/stash.php";

$database = new Dbcomm();
$db = $database->getConnection();

$stash = new Stash($db);

if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['location'])) {
	$data['id'] = $_GET['id'];
	$data['name'] = $_GET['name'];
	$data['location'] = $_GET['location'];
}
else {
	echo "<script>window.location='/Inventorizer/stashes'</script>";
	//echo "<script>console.log('empty values')</script>";
}

//$data = json_decode(file_get_contents("php://input"));

if(!empty($data['id'])) {
	
	$stash->id = $data['id'];
	$stash->name = $data['name'];
	$stash->location = $data['location'];

	if($stash->update()) {
		// response 202 - Accepted
		http_response_code(202);
		// message for user
		//echo json_encode(array("log" => "The requested user was updated! :^)"));
		echo "<script>window.location='/Inventorizer/stashes'</script>";
	}
	else {
		// response 404 - Not Found
		http_response_code(404);
		// message for user
		//echo json_encode(array("log" => "ID not recognized for update! :^("));
		echo "<script>window.location='/Inventorizer/stashes'</script>";
		//echo "<script>console.log('Failed')</script>";
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	//echo json_encode(array("log" => "Invalid ID entry to fulfill the service. :^("));
	echo "<script>window.location='/Inventorizer/stashes'</script>";
	//echo "<script>console.log('Bad id')</script>";
}

?>