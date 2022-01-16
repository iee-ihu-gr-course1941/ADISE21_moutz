<?php
 header("Access-Control-Allow-Origin: http://localhost:8080/");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: POST");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 include_once 'api/objects/game.php';
 
include_once 'api/config/core.php';
include_once 'api/libs/src/BeforeValidException.php';
include_once 'api/libs/src/ExpiredException.php';
include_once 'api/libs/src/SignatureInvalidException.php';
include_once 'api/libs/src/JWT.php';
use \Firebase\JWT\JWT;
$database = new DB();
$db = $database->connect();
$data = json_decode(file_get_contents("php://input"));
$jwt=isset($data->jwt) ? $data->jwt : "";
$game = new Game($db);
$game->id = $data->room;
$bot =$data->isbot;
if($jwt){
 
    try {
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $game->idu =$decoded->data->id;

        if($game->joinroom()){
            if($bot){
                $game->idu = 5; 
                if ($game->joinroom()) {
                    exit(json_encode(array("message" => "bot join")));
            } 
        }
            http_response_code(200);
          
            echo json_encode(array("message" => "join"));
       
    }else{
         
            http_response_code(400);
         
            echo json_encode(array("message" => "Unable to join room."));
        }
    }

 
     catch (Exception $e){
	 
    http_response_code(401);
	 
	    echo json_encode(array(
	        "message" => "Access denied.",
	        "error" => $e->getMessage()
	    ));
	}
}
 
else{
 
    http_response_code(401);
 
    echo json_encode(array("message" => "Access denied."));
}

?>