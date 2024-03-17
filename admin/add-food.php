<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="title of food">
                    </td>

                </tr>


                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food "></textarea>
                    </td>

                </tr>

                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="price" placeholder="price">
                    </td>

                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            //Create PHP code to display categories from database
                            //1.Create SQLt o get all active categories from database
                            //display on dropdown
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //executing Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows to check whether we have categories or not 
                            $count =    mysqli_num_rows($res);
                            //IF count is greater than zero ,we have categories else we dont have categories
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                //we do not have category
                                ?>
                                <option value="0">No Categry Found</option>
                            <?php
                            }
                            //2.display on dropdown
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //check the button click
        if (isset($_POST['submit'])) {
            //add the food  in database 
            //   echo "clicked";
            //get the data from database
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            //check the whether raidon button for featured and active are checked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; //seting default
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //seting default
            }

            //upload the image if selected
            //check the whether the select image is clicked or not and upload the image only if the image is selected
            if (isset($_FILES['image']['name'])) {
                //get the detail of selected image 
                $image_name = $_FILES['image']['name'];
                //check the whether the image is selected or not  and upload image if only if selected

                if ($image_name != "") {
                    //Image is Selected 
                    //A.Rename the image 
                    //get the extension of selected image (jpg,png,gif ...) burger.jpg
                    // $ext=end(explode('.',$image_name));
                    $parts = explode('.', $image_name);
                    $ext = end($parts);
                    //Create new name for Image
                    $image_name = "Food-Name" . rand(000, 999) . "." . $ext; //New Image name maybe "Food-Name-657"
                    //B.Upload the image
                    //get the src Path and destination path

                    //Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];
                    //detination path for the image to be uploaded
                    $dst = "../images/food/" . $image_name;
                    //Finally upload the food image
                    $upload = move_uploaded_file($src, $dst);
                }
                if ($upload == false) {
                    //failed to upload the image
                    //redirect to add food page with error message
                    $_SESSION['upload'] = "<div class ='error'>Failed to upload image.</div>";
                    header('location:' . SITEURL . 'admin/add-food.php');
                }
            } else {
                $image_name = ""; //setting default as blank
            }
            //Insert to database
            //create sql query to save or add food
            //for numberical we dont need to pass value inside quotes ''But for string value it is compulsory to add notes''
            $sql2 = "INSERT INTO tbl_food SET
                            title='$title',
                            description ='$description',
                            price =$price,
                            image_name='$image_name',
                            category_id=$category,
                            featured ='$featured',
                            active='$active'                                                                
                            ";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //check the whether data inserted or not 
            if ($res2 == true) {
                //data insert successfully
                $_SESSION['add'] = "<div class ='success'>Food Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manager-food.php');
            } else {
                //failed to insert data
                $_SESSION['add'] = "<div class ='error'>Food Added Failed.</div>";
                header('location:' . SITEURL . 'admin/manager-food.php');
            }
            //Redirect the message to manage food page
        }


        ?>
    </div>



</div>
<?php include('partials/footer.php') ?>