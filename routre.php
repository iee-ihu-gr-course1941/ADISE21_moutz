<?php
require 'api/config/config.php';

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
 //  print_r($data);
switch ($request_uri[0]) {
        // login main page
    case '/aa/adise2021/routre.php/login':
        require 'api/User/login.php';
        break;
        // register page   
    case '/aa/adise2021/routre.php/register':
        require 'api/User/signup.php';
        break;
        // validate
    case '/aa/adise2021/routre.php/validate':
        require 'api/validate_token.php';
        break;
        // lobbies    
    case '/aa/adise2021/routre.php/getrooms':
        require 'api/game/getallrooms.php';
        break;
        //createroom
    case '/aa/adise2021/routre.php/createroom':
        require 'api/game/createroom.php';
        break;
        //join room
    case '/aa/adise2021/routre.php/joinroom':
        require 'api/game/joinroom.php';
        break;
        //startgme
    case '/aa/adise2021/routre.php/startgame':
        require 'api/game/startgame.php';
        break;    
        //dropcards
    case '/aa/adise2021/routre.php/dropcards':
        require 'api/game/dropcards.php';
        break;
        //selectrandom
    case '/aa/adise2021/routre.php/selectrandom':
        require 'api/game/selectrandom.php';
        break;
    case '/aa/adise2021/routre.php/showdeck':
        require 'api/game/showdeck.php';
        break;
     case '/aa/adise2021/routre.php/getwinner':
        require 'api/game/getwinner.php';
        break;    
    case '/aa/adise2021/routre.php/playerturn':
        require 'api/game/turn.php';
        break;        
        case '/aa/adise2021/routre.php/changeturn':
            require 'api/game/changeturn.php';
            break; 
             case '/aa/adise2021/routre.php/leavegame':
            require 'api/game/leavegame.php';
            break;          
        // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        break;
}
