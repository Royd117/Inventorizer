<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and stash model
include "../resources/config/dbcomm.php";
include "../Models/item.php";

$database = new Dbcomm();
$db = $database->getConnection();

$item = new Item($db);

if(isset($_GET['id'])) {
	$data['id'] = $_GET['id'];
}
else {
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
	else echo "<script>window.location='/Inventorizer/items'</script>";
}

//$data = json_decode(file_get_contents("php://input"));

if(!empty($data['id'])) {
	
	$item->id = $data['id'];
	/*$user->username = $data->username;
	$user->email = $data->email;
	$user->displayname = $data->displayname;
	$user->password = $data->password;*/

	if($item->delete()) {
		// response 202 - Accepted
		http_response_code(202);
		// message for user
		//echo json_encode(array("log" => "The requested stash was deleted! :^)"));
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
		else echo "<script>window.location='/Inventorizer/items'</script>";
	}
	else {
		// response 404 - Not Found
		http_response_code(404);
		// message for user
		//echo json_encode(array("log" => "Requested user was not found. :^("));
		if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
		else echo "<script>window.location='/Inventorizer/items'</script>";
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	//echo json_encode(array("log" => "Invalid entry! ID must be indicated. :^("));
	if(isset($_GET['filter'])) echo "<script>window.location='/Inventorizer/fromCategory/".$_GET['filter']."/items'</script>";
	else echo "<script>window.location='/Inventorizer/items'</script>";
}

?>