<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and stash model
include "../resources/config/dbcomm.php";
include "../Models/item.php";

$database = new Dbcomm();
$db = $database->getConnection();

$item = new Item($db);

if(isset($_GET['name']) && isset($_GET['category']) && isset($_GET['description']) && isset($_GET['quantity']) && isset($_GET['status'])) {
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

//$data = json_decode();

if(
	!empty($data['name']) &&
	!empty($data['category']) &&
	!empty($data['description']) &&
	!empty($data['quantity']) &&
	!empty($data['status'])
){
	//$user->id = $data->id;
	$item->name = $data['name'];
	$item->quantity = $data['quantity'];
	$item->status = $data['status'];
	$item->description = $data['description'];
	$item->category = $data['category'];
	$item->deleted = 0;

	if($item->create()) {
		// response 201 - Created
		http_response_code(201);
		// message for user
		//echo json_encode(array("log" => "The requested user was created! :^)"));
		//Navigate to 'registered.html' screen
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
		else echo "<script>window.location='/Inventorizer/items'</script>";
	}
	else {
		// response 500 - Internal Server Error
		http_response_code(500);
		// message for user
		//echo json_encode(array("log" => "An error occurred with the service. :^("));
		//Navigate back to 'registered.html' screen
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
		else echo "<script>window.location='/Inventorizer/items'</script>";
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	//echo json_encode(array("log" => "Invalid entry! Parameters cannot be null. :^("));
	//Navigate back to 'registered.html' screen
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
	else echo "<script>window.location='/Inventorizer/items'</script>";
}
?>