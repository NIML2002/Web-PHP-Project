<?php include('.//partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
<br/><br/>


<?php 
    if(isset($_SESSION['add']))
    {
            echo$_SESSION['add'];
            unset($_SESSION['add']);

    }
    if(isset($_SESSION['upload']))
    {
            echo$_SESSION['upload'];
            unset($_SESSION['upload']);

    }

?>
<br/><br/>
        <!--add category from start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                    
                </tr>
                
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                
                </td>
                    
                </tr>


                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    
                    </td>
                    
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>



        </form>
 <!--add category form end -->

        <?php 
            if(isset($_POST['submit']))
            {
                //get the value  from form
                $title=$_POST['title'];
                //for radio input ,we need to check where the button is selected or not 
                if(isset($_POST['featured']))
                {
                    //get the value form form
                    $featured=$_POST['featured'];

                }else{
                        //set the default value
                        $featured ='No';
                }
                if(isset($_POST['active']))
                {
                    //get the value form form
                    $active=$_POST['active'];

                }else{
                        //set the default value
                        $active ='No';
                }
                //check the whether image selected or not and set the value for image name accordingly
              //  print_r($_FILES['image']);
                //die();
                    if(isset($_FILES['image']['name']))
                    {
                        //upload the image

                        $image_name =$_FILES['image']['name'];
                        //upload the image only if image is selected
                        if($image_name !="")
                        {
                        //auto rename our Image
                        //Get the Extension of our Images (jpg,png,gif,etc) 
                        $ext=end(explode('.',$image_name));
                        //Rename the Images
                        $image_name ="Food_Category_".rand(000,999).'.'.$ext;//eg Food_Category_834.jpg
                        $source_path =$_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name;
                        //finally upload the image
                        $upload=move_uploaded_file($source_path,$destination_path);
                        //check whether the images is uploaded or not 
                        //and if the images is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            $_SESSION['upload']= "<div class='error'>Failed to upload image.</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }
                        }    
                }
                else{
                    //dont upload the image and set the image_name as blank
                    $image_name ="";

                }
                // Create sql query to insert category into Database
                $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";
                    //Execute the query and save in data base
                    $res=mysqli_query($conn,$sql);
                    if($res==true){
                        $_SESSION['add']="<div class='success'> Category Added Successfully.</div>";
                        //redirect to manage Category Page
                        header('location:'.SITEURL.'admin/manager-category.php');
                    }
                    else{
                        //Failed to add category
                        $_SESSION['add']="<div class='error'> Category Added Fail.</div>";
                        //redirect to manage Category Page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
            }
        
        ?>
    </div>




</div>






<?php include('.//partials/footer.php');?>