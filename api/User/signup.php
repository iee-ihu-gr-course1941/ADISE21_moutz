<?php
 header("Access-Control-Allow-Origin: http://localhost:8080/");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: POST");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 include_once 'api\config\config.php';
 
include_once 'api/objects/user.php';
 
$database = new DB();
$db = $database->connect();
 
$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
$user->username = $data->username;
$user->password = $data->password;

$user->email = $data->email;
// create the user

    if($user->signup()){
 
        http_response_code(200);
     
        echo json_encode(array("message" => "User was created."));
    }
     
    else{
     
        http_response_code(400);
     
        echo json_encode(array("message" => "Unable to create user."));
    }
    ?>
    