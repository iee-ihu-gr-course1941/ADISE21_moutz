<?php
 header("Access-Control-Allow-Origin: http://localhost:8080/");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: POST");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/config.php';
 
include_once '../objects/friend.php';
 
$database = new DB();
$db = $database->connect();
 
$friend = new Friend($db);
$data = json_decode(file_get_contents("php://input"));
$friend->id_senter = $data->id_senter;
$friend->id_receiver = $data->id_receiver; 

// create the friend

    if($friend->addfriend()){
 
        http_response_code(200);
     
        echo json_encode(array("message" => "friend was created."));
    }
     
    else{
     
        http_response_code(400);
     
        echo json_encode(array("message" => "Unable to create friend."));
    }
    ?>
    