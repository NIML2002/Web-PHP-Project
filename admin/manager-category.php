<?php include('partials/menu.php') ;?>

<div class="main-content">
                <div class="wrapper">
                <h1>Manager Category</h1>

                <br /><br />

                <?php 
    if(isset($_SESSION['add']))
    {
            echo$_SESSION['add'];
            unset($_SESSION['add']);

    }
    if(isset($_SESSION['remove']))
    {
            echo$_SESSION['remove'];
            unset($_SESSION['remove']);

    }
    if(isset($_SESSION['delete']))
    {
            echo$_SESSION['delete'];
            unset($_SESSION['delete']);

    }
    if(isset($_SESSION['no-category-found']))
    {
            echo$_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);

    }
    if(isset($_SESSION['upload']))
    {
            echo$_SESSION['upload'];
            unset($_SESSION['upload']);

    }

?>
<br/><br/>
    <!--- button admin --->
    <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
    <br /><br />
    <table class="tbl-full">
      <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
      </tr>
      <?php
        //Query to get all categories from database
        $sql="SELECT * FROM tbl_category";
      //execute the query
      $res=mysqli_query($conn,$sql);
      //Count rows
      $count= mysqli_num_rows($res);
      //Create Serial Number Variable and assign value as 1
      $sn=1;
      //check the whether we have data in database or not
      if($count>0)
      {
        //we have data in database
        //get the data and display
        while($row =mysqli_fetch_assoc($res))
        {
          $id=$row['id'];
          $title=$row['title'];
          $image_name=$row['image_name'];
          $featured=$row['featured'];
          $active=$row['active'];
         ?> 

          <tr>
        <td><?php echo $sn++; ?>.</td>
        <td><?php echo $title; ?></td>
        <td>
          <?php
//check the whether the image name is available or not 
            if($image_name!="")
            {
              //display the image
              ?> 
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
              <?php
            }
            else
            {
              //display the message
              echo"<div class ='error'>Image not Added.</div>";
            }
         
         ?></td>
        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td>
         <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a> 
         <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a> 
        </td>
      </tr> 
      
      <?php
        }
      }
      else{
        //no data
        //display the message
        ?>
          <tr>
            <td colspan="6">
              <div class="error">No Category Added.</div>
            </td>
          </tr>
        <?php
      }
      
      
      ?>
      
     
    </table>
               
                
            </div>
<?php include('partials/footer.php'); ?>