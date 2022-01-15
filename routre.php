<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  try {
require 'api/config/config.php';


$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
// print_r($request_uri);
switch ($request_uri[0]) {
        // login main page
    case '/~it185222/ADISE21_moutz/routre.php/login':
        require 'api/User/login.php';
        break;
        // register page   
    case '/~it185222/ADISE21_moutz/routre.php/register':
        require 'api/User/signup.php';
        break;
        // validate
    case '/~it185222/ADISE21_moutz/routre.php/validate':
        require 'api/validate_token.php';
        break;
        // lobbies    
    case '/~it185222/ADISE21_moutz/routre.php/getrooms':
        require 'api/game/getallrooms.php';
        break;
        //createroom
    case '/~it185222/ADISE21_moutz/routre.php/createroom':
        require 'api/game/createroom.php';
        break;
        //join room
    case '/~it185222/ADISE21_moutz/routre.php/joinroom':
        require 'api/game/joinroom.php';
        break;
        //startgme
    case '/~it185222/ADISE21_moutz/routre.php/startgame':
        require 'api/game/startgame.php';
        break;    
        //dropcards
    case '/~it185222/ADISE21_moutz/routre.php/dropcards':
        require 'api/game/dropcards.php';
        break;
        //selectrandom
    case '/~it185222/ADISE21_moutz/routre.php/selectrandom':
        require 'api/game/selectrandom.php';
        break;
         //selectrandom
    case '/~it185222/ADISE21_moutz/routre.php/showdeck':
        require 'api/game/showdeck.php';
        break;
     case '/~it185222/ADISE21_moutz/routre.php/getwinner':
        require 'api/game/getwinner.php';
        break;    
    case '/~it185222/ADISE21_moutz/routre.php/playerturn':
        require 'api/game/turn.php';
        break;        
    case '/~it185222/ADISE21_moutz/routre.php/changeturn':
        require 'api/game/changeturn.php';
        break; 
    case '/~it185222/ADISE21_moutz/routre.php/leavegame':
        require 'api/game/leavegame.php';
        break;        
    case '/~it185222/ADISE21_moutz/routre.php/getusername':
        require 'api/user/getUsername.php';
        break;
            
        // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        break;
        
}
catch (Exception $e){
	 
    http_response_code(401);
	 
	    echo json_encode(array(
	        "message" => "Access denied.",
	        "error" => $e->getMessage()
	    ));
	}
}