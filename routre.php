<?php
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
switch ($request_uri[0]) {
        // login main page
    case '/aa/adise2021/routre.php/login':
        require 'api/User/login.php';
        //  print_r($data);
        break;
        // register page   
    case '/aa/adise2021/routre.php/register':
        // print_r($data);
        require 'api/User/signup.php';
        break;
        // validate
    case '/aa/adise2021/routre.php/validate':
        require 'api/validate_token.php';
        break;
        //     // lobbies    
    case '/aa/adise2021/routre.php/createroom':
        require 'api/game/createroom.php';
        break;
    case '/aa/adise2021/routre.php/join':
        require 'api/game/join.php';
        break;
    case '/aa/adise2021/routre.php/dropcards':
        require 'api/game/dropcards.php';
        break;
    case '/aa/adise2021/routre.php/dropcards':
        require 'api/game/dropcards.php';
        break;
    case '/aa/adise2021/routre.php/selectrandom':
        require 'api/game/selectrandom.php';
        break;
    case '/aa/adise2021/routre.php/showdeck':
        require 'api/game/showdeck.php';
        break;
    case '/aa/adise2021/routre.php/startgame':
        require 'api/game/startgame.php';
        break;

        //     // Everything else
    default:
        // header('HTTP/1.0 404 Not Found');
        // require '../views/404.php';
        break;
}
