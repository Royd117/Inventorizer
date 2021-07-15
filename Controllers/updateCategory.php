<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and user model
include "../resources/config/dbcomm.php";
include "../Models/category.php";

$database = new Dbcomm();
$db = $database->getConnection();

$category = new Category($db);

if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['stash'])) {
	$data['id'] = $_GET['id'];
	$data['name'] = $_GET['name'];
	$data['stash'] = $_GET['stash'];
}
else {
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromStash/".$_GET['filter']."/categories'</script>";
	else echo "<script>window.location='/Inventorizer/categories'</script>";
}

//$data = json_decode(file_get_contents("php://input"));

if(!empty($data['id'])) {
	
	$category->id = $data['id'];
	$category->name = $data['name'];
	$category->stash = $data['stash'];

	if($category->update()) {
		// response 202 - Accepted
		http_response_code(202);
		// message for user
		//echo json_encode(array("log" => "The requested user was updated! :^)"));
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromStash/".$_GET['filter']."/categories'</script>";
		else echo "<script>window.location='/Inventorizer/categories'</script>";
	}
	else {
		// response 404 - Not Found
		http_response_code(404);
		// message for user
		//echo json_encode(array("log" => "ID not recognized for update! :^("));
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromStash/".$_GET['filter']."/categories'</script>";
		else echo "<script>window.location='/Inventorizer/categories'</script>";
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	//echo json_encode(array("log" => "Invalid ID entry to fulfill the service. :^("));
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromStash/".$_GET['filter']."/categories'</script>";
	else echo "<script>window.location='/Inventorizer/categories'</script>";
}

?>