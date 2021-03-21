<?php

//Start session
session_start();
//Create constants
define('SESSION_URL','http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'food-order');

$conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error());
$db_select = mysqli_select_db($conn, DBNAME) or die(mysqli_error());
?>