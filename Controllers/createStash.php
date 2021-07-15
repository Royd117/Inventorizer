<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and stash model
include "../resources/config/dbcomm.php";
include "../Models/stash.php";

session_start();

$database = new Dbcomm();
$db = $database->getConnection();

$stash = new Stash($db);

if(isset($_GET['name']) && isset($_GET['location']) && isset($_SESSION['userid'])) {
	$data['name'] = $_GET['name'];
	$data['location'] = $_GET['location'];
	$data['user'] = $_SESSION['userid'];
}
else {
	//echo "<script>console.log('Params unset')</script>";
	//echo "vars: ".$_GET['name'].", ".$_GET['location'].", ".$_SESSION['userid'];
	echo "<script>window.location='/Inventorizer/stashes'</script>";
}

//$data = json_decode();

if(
	!empty($data['name']) &&
	!empty($data['location']) &&
	!empty($data['user'])
){
	//$user->id = $data->id;
	$stash->name = $data['name'];
	$stash->location = $data['location'];
	$stash->user = $data['user'];
	$stash->deleted = 0;

	if($stash->create()) {
		// response 201 - Created
		http_response_code(201);
		// message for user
		//echo json_encode(array("log" => "The requested user was created! :^)"));
		//Navigate to 'registered.html' screen
		echo "<script>window.location='/Inventorizer/stashes'</script>";
	}
	else {
		// response 500 - Internal Server Error
		http_response_code(500);
		// message for user
		//echo json_encode(array("log" => "An error occurred with the service. :^("));
		//Navigate back to 'registered.html' screen
		//echo "<script>console.log('Create failed')</script>";
		echo "<script>window.location='/Inventorizer/stashes'</script>";
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	//echo json_encode(array("log" => "Invalid entry! Parameters cannot be null. :^("));
	//Navigate back to 'registered.html' screen
	//echo "<script>console.log('Empty found')</script>";
	echo "<script>window.location='/Inventorizer/stashes'</script>";
}
?>