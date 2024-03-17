<?php 
//start Session
session_start();
    //create Contrants  to Store Non Repeating values
    define('SITEURL','http://localhost/food-order/');
    define('LocalHost','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');

$conn = mysqli_connect(LocalHost,DB_USERNAME,DB_PASSWORD)or die(mysqli_error());//database connection
$db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//selecting database
?>