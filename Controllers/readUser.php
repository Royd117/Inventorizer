<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database and user model
include "../resources/config/dbcomm.php";
include "../Models/user.php";

$database = new Dbcomm();
$db = $database->getConnection();

$user = new User($db);

$user->username = isset($_GET['username']) ? $_GET['username'] : die();

$user->read();

//var_dump($user);
	  
if(!empty($user->id) && !empty($user->username)){
    
    // create display
    $aux = array();

    $display = array(
        "id" =>  $user->id,
        "username" => $user->username,
        "email" => $user->email,
        "displayname" => $user->displayname,
        "password" => $user->password
    );

    array_push($aux, $display);
  
    // set response code - 200 OK
    if($user->deleted!=1) {
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