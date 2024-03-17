<?php include('../config/constants.php'); ?>


<html>
<head>
    
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="short icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="hero">

        <div class="login_form">

            <h1>Login</h1>
            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset( $_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>

            <form class="input_box" method="POST">

                <input type="text" name="username" class="username" placeholder="User Name">
                <input type="password" name="password" class="password" maxlength="10" placeholder="Password">
                
                <input type="submit" name="submit" value="Login" class="submit"></input>

                <div class="social_icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-google"></i>
                </div>

                

            </form>

        </div>

    </div>
    
</body>
</html>
<?php


//check the whether the sumbit button or not 
if(isset($_POST['submit']))
{
    //process for login
    //1. get the data from login
    $username=$_POST['username'];
    $password=md5($_POST['password']);
   //2.sql to check whether the user with username and password exist or not 
  $sql="SELECT *FROM tbl_admin WHERE username ='$username'AND password='$password'";
   //3,execute the query
   $res = mysqli_query($conn,$sql);
   //4.Count Rows to check whether the user exist or not 
   $count=mysqli_num_rows($res);
   if($count==1)
   {
    //user available and login succes
        $_SESSION['login'] ="<div class ='success'> Login Succesfully.</div>";
        $_SESSION['user'] =$username;//check the login or not 
        header('location:'.SITEURL.'admin/');


   }else
   {
    //user fail and send message
    $_SESSION['login'] ="<div class ='error'> Username or Password not correct.</div>";
    header('location:'.SITEURL.'admin/login.php');
   }
}
?>