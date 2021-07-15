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

//$category->name = isset($_GET['name']) ? $_GET['name'] : die();
if(isset($_GET['name']) && isset($_GET['category'])){
    $item->name = $_GET['name'];
    $item->stash = $_GET['category'];
} else die();

$auxitem = $item->filter($_GET['name'],$_GET['category']);

//var_dump($user);

if(!empty($auxitem)){
    
    $display = array();

    foreach ($auxitem as $unit) {
       // create display
        $coin = array(
            "id" => $unit['id'],
            "name" => $unit['name'],
            "category" => $unit['category'],
            "description" => $unit['description'],
            "quantity" => $unit['quantity'],
            "status" => $unit['status']
        );

        array_push($display,$coin);
    }
        
    //echo "Username: " . $coin['username'];
    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    $json = json_encode($display);
    echo $json;
}

else {
    // response 404 - Not Found
    http_response_code(404);
    // message for user
    echo json_encode(array("log" => "No matching users were found in the records :^("));
}



?>