<?php
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
print_r($request_uri);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../apicalls/user.js"></script>

 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signupForm.css">
      <title>Signup Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
</head>
<body>

    <form id= "sign_up_form">

        <h2>Εγγραφή χρηστη</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username"><br><br>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password"><br><br>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Type e-mail"><br><br>
       
        <button  type="submit" class='btn btn-primary'>Εγγραφή</button>
        <a href="../page/loginForm.html">
            <button type="button">Έχω ήδη λογαριασμό</button>
        </a>
        
         
    </form> 
 
    
</body>
</html>