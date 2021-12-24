<?php
error_reporting(E_ALL);

date_default_timezone_set('Europe/Zagreb');
 
// variables for jwt
$key = "example_key";
$iss = "http://localhost:8080/adise2021/";
$issat = time();
$exptime = $issat + (60 * 60); // valid for 1 hour
?>