<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database and user model
include "../resources/config/dbcomm.php";
include "../Models/category.php";

$database = new Dbcomm();
$db = $database->getConnection();

$category = new Category($db);

$category->name = isset($_GET['name']) ? $_GET['name'] : die();

$category->read();

//var_dump($user);
	  
if(!empty($category->id) && !empty($category->name)){
    
    // create display
    $aux = array();

    $display = array(
        "id" =>  $category->id,
        "name" => $category->name,
        "stash" => $category->stash
    );

    array_push($aux, $display);
  
    // set response code - 200 OK
    if($category->deleted!=1) {
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