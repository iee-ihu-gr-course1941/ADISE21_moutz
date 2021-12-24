<?php
header("Access-Control-Allow-Origin: http://localhost:8080/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'api\config\config.php';
include_once 'api\objects\user.php';


$database = new DB();
$db = $database->connect();
 
$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

$user->username = $data->username;
$user_exists = $user->userExists();
include_once 'api/config/core.php';
include_once 'api/libs/src/BeforeValidException.php';
include_once 'api/libs/src/ExpiredException.php';
include_once 'api/libs/src/SignatureInvalidException.php';
include_once 'api/libs/src/JWT.php';
use \Firebase\JWT\JWT;
 
// if user exists and if password is correct
if($user_exists && password_verify($data->password, $user->password)){
 
    $token = array(
       "issat" => $issat,
       "exptime" => $exptime,
       "iss" => $iss,
       "data" => array(
           "id" => $user->id,
           "username" => $user->username,
           "email" => $user->email
       )
    );
 
    http_response_code(200);
 
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );
 
}
 
else{
 
    http_response_code(401);
 
    echo json_encode(array("message" => "Login failed."));
}
?>
