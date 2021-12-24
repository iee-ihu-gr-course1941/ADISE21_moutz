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
    // hub page
//     case '/hub':
//         require '../views/hub.php';
//         break;
//     // lobbies    
//    case '/hub':
//         require '../views/lobbies.php';
//         break;        
//     // Everything else
    default:
        // header('HTTP/1.0 404 Not Found');
        // require '../views/404.php';
        break;
}
?>