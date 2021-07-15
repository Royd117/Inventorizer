<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and stash model
include "../resources/config/dbcomm.php";
include "../Models/category.php";

$database = new Dbcomm();
$db = $database->getConnection();

$category = new Category($db);

if(isset($_GET['name']) && isset($_GET['stash'])) {
	$data['name'] = $_GET['name'];
	$data['stash'] = $_GET['stash'];
}
else {
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromStash/".$_GET['filter']."/categories'</script>";
	else echo "<script>window.location='/Inventorizer/categories'</script>";
}

//$data = json_decode();

if(
	!empty($data['name']) &&
	!empty($data['stash'])
){
	//$user->id = $data->id;
	$category->name = $data['name'];
	$category->stash = $data['stash'];
	$category->deleted = 0;

	if($category->create()) {
		// response 201 - Created
		http_response_code(201);
		// message for user
		//echo json_encode(array("log" => "The requested user was created! :^)"));
		//Navigate to 'registered.html' screen
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromStash/".$_GET['filter']."/categories'</script>";
		else echo "<script>window.location='/Inventorizer/categories'</script>";
	}
	else {
		// response 500 - Internal Server Error
		http_response_code(500);
		// message for user
		//echo json_encode(array("log" => "An error occurred with the service. :^("));
		//Navigate back to 'registered.html' screen
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromStash/".$_GET['filter']."/categories'</script>";
		else echo "<script>window.location='/Inventorizer/categories'</script>";
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	//echo json_encode(array("log" => "Invalid entry! Parameters cannot be null. :^("));
	//Navigate back to 'registered.html' screen
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromStash/".$_GET['filter']."/categories'</script>";
	else echo "<script>window.location='/Inventorizer/categories'</script>";
}
?>