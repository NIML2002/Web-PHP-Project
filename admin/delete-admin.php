<?php 
//Include constrants.php file here
    include('../config/constants.php');
    //get the id of admin to be deleted
      //echo
        $id =$_GET['id'];
    //Create Sql query to delete admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";
//execute the query
    $res =mysqli_query($conn,$sql);
    //check the whether the query executed succesfully or not
    if($res == True){
        //query executed and admin deleted
      // echo 'admin deleted';
      //Create Session variable to display message 
      $_SESSION['delete']="<div class ='success'>Admin Deleted Successfully.</div>";
      //Redirect to Manager Admin Page
      header('location:'.SITEURL.'admin/manager-admin.php');
    }
    else{
        //faild to delete
        //echo'fail to delete admin';
        $_SESSION['delete']="<div class='error'>Admin Deleted Fail.Try again later.</div>";
        header('location:'.SITEURL.'admin/manager-admin.php');
    }
    //Redirect to manage admin page with message 
    

?>