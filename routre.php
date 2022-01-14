<?php
require 'api/config/config.php';

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
        // login main page
    case '/ADISE21moutz/routre.php/login':
        require 'api/User/login.php';
        break;
        // register page   
    case '/ADISE21moutz/routre.php/register':
        require 'api/User/signup.php';
        break;
        // validate
    case '/ADISE21moutz/routre.php/validate':
        require 'api/validate_token.php';
        break;
        // lobbies    
    case '/ADISE21moutz/routre.php/getrooms':
        require 'api/game/getallrooms.php';
        break;
        //createroom
    case '/ADISE21moutz/routre.php/createroom':
        require 'api/game/createroom.php';
        break;
        //join room
    case '/ADISE21moutz/routre.php/joinroom':
        require 'api/game/joinroom.php';
        break;
        //startgme
    case '/ADISE21moutz/routre.php/startgame':
        require 'api/game/startgame.php';
        break;    
        //dropcards
    case '/ADISE21moutz/routre.php/dropcards':
        require 'api/game/dropcards.php';
        break;
        //selectrandom
    case '/ADISE21moutz/routre.php/selectrandom':
        require 'api/game/selectrandom.php';
        break;
         //selectrandom
    case '/ADISE21moutz/routre.php/showdeck':
        require 'api/game/showdeck.php';
        break;
     case '/ADISE21moutz/routre.php/getwinner':
        require 'api/game/getwinner.php';
        break;    
    case '/ADISE21moutz/routre.php/playerturn':
        require 'api/game/turn.php';
        break;        
    case '/ADISE21moutz/routre.php/changeturn':
        require 'api/game/changeturn.php';
        break; 
    case '/ADISE21moutz/routre.php/leavegame':
        require 'api/game/leavegame.php';
        break;        
    case '/ADISE21moutz/routre.php/getusername':
        require 'api/user/getUsername.php';
        break;
            
        // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        break;
}
