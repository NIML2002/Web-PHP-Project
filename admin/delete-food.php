<?php 
    include('../config/constants.php');
    if(isset($_GET['id']) && isset($_GET['image_name']))//either use '&&' or 'AND'
    {
        
        
     //process to delete
      //  echo"Process to delete";
      //1.get id and Image name
      $id=$_GET['id'];
      $image_name=$_GET['image_name'];

      //2. remove the image if available
      //check whether the image available or not and delete if available
      if($image_name != "")
      {
        //IT has image and need to remove from folder
        //get the image path
        $path="../images/food/".$image_name;
        //remove image file from folder 
        $remove =unlink($path);
        //check whether the image is removed or not  
        if($remove ==false)
        {
            //Failed to Remove image
            $_SESSION['upload']="<div class ='error'>Failed to remove Image File.</div>";
            //redirect to manage food
            header('location:'.SITEURL.'admin/manager-food.php');
            //stop the proccessing delete
            die();
        }
      }
      //3.Delete Food from database
      $sql ="DELETE FROM tbl_food WHERE id=$id";
      //execute the query
      $res=mysqli_query($conn,$sql);
      //check whether the query executed or not and set the session message respectively
      if($res==true)
      {
        //food delete
        $_SESSION['delete']="<div class ='success'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manager-food.php');
        
      }
      else{
        //fail to delete food
        $_SESSION['delete']="<div class ='error'>Food Deleted deleted.</div>";
        header('location:'.SITEURL.'admin/manager-food.php');
      }
      

    }
    else{
       // echo"redirect";
       $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
       header('location:'.SITEURL.'admin/manager-food.php');
     
    }


?>