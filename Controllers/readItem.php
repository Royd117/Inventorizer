<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database and user model
include "../resources/config/dbcomm.php";
include "../Models/item.php";

$database = new Dbcomm();
$db = $database->getConnection();

$item = new Item($db);

$item->name = isset($_GET['name']) ? $_GET['name'] : die();

$item->read();

//var_dump($user);
	  
if(!empty($item->id) && !empty($item->name)){
    
    // create display
    $aux = array();

    $display = array(
        "id" =>  $item->id,
        "name" => $item->name,
        "category" => $item->category,
        "description" => $item->description,
        "quantity" => $item->quantity,
        "status" => $item->status
    );

    array_push($aux, $display);
  
    // set response code - 200 OK
    if($item->deleted!=1) {
        http_response_code(200);
    }
    else {
        http_response_code(204);
    }
  
    // make it json format
    $jsondisplay = json_encode($aux); 
    echo $jsondisplay;
}


	/*$display = array(
		"id" => $item['id'],
		"username" => $item['username'],
		"email" => $item['email'],
		"displayname" => $item['displayname'],
		"password" => $item['password'],
	);*/

else {
	// response 404 - Not Found
	http_response_code(404);
	// message for user
	echo json_encode(array("log" => "ID not recognized for reading! :^("));
}



?>