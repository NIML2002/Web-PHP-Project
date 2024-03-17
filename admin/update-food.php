<?php include('partials/menu.php') ?>
<?php 
    //check the whether id is set or not 
    if(isset($_GET['id']))
    {
        //get all the detail
        $id=$_GET['id'];
        //sql query to get the selected food
        $sql2="SELECT *FROM tbl_food WHERE id =$id";
        //execute the query 
        $res2=mysqli_query($conn,$sql2);
        //get the value based on query executed
        $row2=mysqli_fetch_assoc($res2);
        //get the Individual Values of Selected Food
        $title=$row2['title'];
        $description=$row2['description'];
        $price=$row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];                                 
    }
?>
<?php 
    if(isset($_POST['submit']))
    {
        //1 get all the details from form
        $id=$_POST['id'];
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $current_image=$_POST['current_image'];
        $category=$_POST['category'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];

        //2 upload the image if selected
        //check the whether upload button is clicked or not 
        if(isset($_FILES['image']['name']))
        {
            //upload Button Clicked
            $image_name=$_FILES['image']['name'];
            //check the whether th file is available or not 
            if($image_name !="")
            {
                //image is avalable 
                //A.Uploading new Image

                //rename the Image
                $parts = explode('.', $image_name);
                $ext = end($parts);
                //get the extension of the image

                $image_name ="Food-Name-".rand(0000,9999).'.'.$ext;//this will we rename image 
                //get the source path and destinaton path
                $src_path=$_FILES['image']['tmp_name'];//source path
                $dest_path ="../images/food/".$image_name;
                //Upload the image
                $upload =move_uploaded_file($src_path,$dest_path);
                //check the whether the image is uploaded or not 
                if($upload ==false)
                {
                    $_SESSION['upload']="<div class ='error'>Failed to upload image.</div>";
                    header('location:'.SITEURL.'admin/manager-food.php');
                    die();
                }
                //3 remove the image if new image is uploaded and current image exist
                //b.remove current image if available
                if($current_image != "")
                {
                    //Current Image is available
                    //Remove the image
                    $remove_path="../images/food/".$current_image;
                    $remove =unlink($remove_path);
                    //check the whether the image is removed or not
                    if($remove==false)
                    {
                        $_SESSION['remove-failed']="<div class ='error'>Remove Image Fail.</div>";
                    header('location:'.SITEURL.'admin/manager-food.php');
                    die();
                    }

                }
            }else{
                $image_name=$current_image;
            }
        }
        else{
            $image_name=$current_image;
        }
        
            //4.update the food in database
                    $sql3="UPDATE tbl_food SET
                    title='$title',
                    description ='$description',
                     price =$price,
                    image_name='$image_name',
                    category_id='$category',
                  featured ='$featured',
                    active='$active'  
                    WHERE id=$id   
                    ";
                    //execute the sql query
                    $res3=mysqli_query($conn,$sql3);
                    //check  whether the query is executed or not
                    if($res3==true)
                    {
                        //query executed and food update
                        $_SESSION['update']="<div class='success'>Food Update Successfully.</div>";
                        header('location:'.SITEURL.'admin/manager-food.php');
                    }
                    else
                    {
                        //failed to update food
                        $_SESSION['update']="<div class='error'>Food Update Failed.</div>";
                        header('location:'.SITEURL.'admin/manager-food.php');
                    }
        //redirect  to manage food with session message

    }
?>

<div class="maim-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br /><br />
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="col-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                    </tr>
                
                
                
                    <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                

                <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php 
                            if($current_image=="")
                            {
                                echo "<div class ='error'>Image not available.</div>";
                            }
                            else{
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="" width="100px"> 
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Select new Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>


                <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                <?php 
                                    //query to get active categories
                                    $sql="SELECT *FROM tbl_category WHERE active='Yes'";
                                    //execute the query
                                    $res=mysqli_query($conn,$sql);
                                    //Count rows
                                    $count=mysqli_num_rows($res);
                                    //check the whether category available or not 
                                    if($count>0)
                                    {
                                        //category available
                                        while($row =mysqli_fetch_assoc($res))
                                        {
                                            $category_title=$row['title'];
                                            $category_id=$row['id'];
                                            
                                            //echo "<option value='$category_id'>$category_title</option>";
                                            ?> 
                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                            <?php
                                            
                                        }
                                    }
                                    else{
                                        //category not available
                                        echo"<option value='0'>Category not available.</option>";

                                    }
                                ?>
                                
                            </select>
                        </td>
                 </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No"){echo "checked";} ?>type="radio" name="featured" value="No">No
                            
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active =="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active =="No"){ echo "checked";}?> type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
            </table>

        </form>
    </div>
</div>





<?php include('partials/footer.php') ?>