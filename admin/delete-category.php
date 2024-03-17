<?php
//include Constants Files
include('../config/constants.php');
//echo"delete page ";
//check the whether id and image name value is set or not 
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //get the value and delete
    //   echo "get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //remove the physical images file is available
    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        //remove the image
        $remove = unlink($path);
        //if failed to remove image then add an error message and stop the process
        if ($remove == false) {
            //set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";

            //redirect to manager category
            header('location:' . SITEURL . 'admin/manager-category.php');
            //stop the process
            die();
        }
    }
    //delete data from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the data is delete form database or not 
    if ($res == true) {
        //set success message and redirect
        $_SESSION['delete'] = "<div class ='success'>Category deleted successfully.</div>";
        //redirect to manager category page with message
        header('location:'.SITEURL.'admin/manager-category.php');

    } else {
        $_SESSION['delete'] = "<div class ='errorr'>Category deleted failed.</div>";
        //redirect to manager category page with message
        header('location:'.SITEURL.'admin/manager-category.php');
    }
} else {
    //redirect to manage category page
    header('location:' . SITEURL . 'admin/manager-category.php');
}
