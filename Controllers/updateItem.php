<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and user model
include "../resources/config/dbcomm.php";
include "../Models/item.php";

$database = new Dbcomm();
$db = $database->getConnection();

$item = new Item($db);

if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['category']) && isset($_GET['description']) && isset($_GET['quantity']) && isset($_GET['status'])) {
	$data['id'] = $_GET['id'];
	$data['name'] = $_GET['name'];
	$data['category'] = $_GET['category'];
	$data['description'] = $_GET['description'];
	$data['quantity'] = $_GET['quantity'];
	$data['status'] = $_GET['status'];
}
else {
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
	else echo "<script>window.location='/Inventorizer/items'</script>";
}

//$data = json_decode(file_get_contents("php://input"));

if(!empty($data['id'])) {
	
	$item->id = $data['id'];
	$item->name = $data['name'];
	$item->category = $data['category'];
	$item->description = $data['description'];
	$item->quantity = $data['quantity'];
	$item->status = $data['status'];

	if($item->update()) {
		// response 202 - Accepted
		http_response_code(202);
		// message for user
		//echo json_encode(array("log" => "The requested user was updated! :^)"));
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
		else echo "<script>window.location='/Inventorizer/items'</script>";
	}
	else {
		// response 404 - Not Found
		http_response_code(404);
		// message for user
		//echo json_encode(array("log" => "ID not recognized for update! :^("));
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
		else echo "<script>window.location='/Inventorizer/items'</script>";
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	//echo json_encode(array("log" => "Invalid ID entry to fulfill the service. :^("));
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
	else echo "<script>window.location='/Inventorizer/items'</script>";
}

?>