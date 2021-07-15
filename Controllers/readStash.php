<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database and user model
include "../resources/config/dbcomm.php";
include "../Models/stash.php";

$database = new Dbcomm();
$db = $database->getConnection();

$stash = new Stash($db);

$stash->name = isset($_GET['name']) ? $_GET['name'] : die();

$stash->read();

//var_dump($user);
	  
if(!empty($stash->id) && !empty($stash->name)){
    
    // create display
    $aux = array();

    $display = array(
        "id" =>  $stash->id,
        "name" => $stash->name,
        "location" => $stash->location,
        "user" => $stash->user
    );

    array_push($aux, $display);
  
    // set response code - 200 OK
    if($stash->deleted!=1) {
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