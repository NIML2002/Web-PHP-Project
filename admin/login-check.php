<?php 
    //check whether the user is logged or not 
    //access con trol
    if(!isset($_SESSION['user']))//if user session is not set
    {
            //user is not logged in 
            $_SESSION['no-login-message']="<div class='error'>Please login to acces Admin Panel.</div>";
            header('location:'.SITEURL.'admin/login.php');
    }

?>