<?php
 header("Access-Control-Allow-Origin: http://localhost:8080/");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: POST");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 include_once 'api/validate_token.php';
 include_once 'api/objects/game.php';
 
$database = new DB();
$db = $database->connect();
$data = json_decode(file_get_contents("php://input"));

$game = new Game($db);
$game->idu = $decoded['id'];;


if($game->selectrandom()){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "User was created."));
}
 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create user."));
}
?>