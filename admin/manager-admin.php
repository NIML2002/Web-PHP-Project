<?php include('partials/menu.php') ?>
<!-- Menu Section End -->

<!-- Main Content Section Starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manager Admin</h1>
    <br /><br />
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add']; //Displaying Session Message
      unset($_SESSION['add']); //REmove Session Message
    }
    if(isset($_SESSION['delete'])){
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    if(isset($_SESSION['update'])){
      echo $_SESSION['update'];
      unset ($_SESSION['update']);
    }
    if(isset($_SESSION['user-not-found']))
    {
      echo $_SESSION['user-not-found'];
      unset ($_SESSION['user-not-found']);
    }
    if(isset($_SESSION['pwd-not-match']))
    {
      echo $_SESSION['pwd-not-match'];
      unset ($_SESSION['pwd-not-match']);
    }
    if(isset($_SESSION['change-pwd']))
    {
      echo $_SESSION['change-pwd'];
      unset ($_SESSION['change-pwd']);
    }
    ?>
    <br /><br /><br />
    <!--- button admin --->
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br /><br />

    <table class="tbl-full">
      <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>UserName</th>
        <th>Actions</th>
      </tr>
      <?php
      //query to get all admin
      $sql = "SELECT * FROM tbl_admin";
      //execute  the query
      $res = mysqli_query($conn, $sql);
      //check whether the query is execute or not 
      if ($res==TRUE) {
        //Count Row to check whether we have data in database or not 
        $count = mysqli_num_rows($res); //function to get all rows in data
        //check the num of rows
        // $sn=1; if u want to your id dont same like database sqlite in line 51,u can replace $id =$sn++
        if ($count > 0) {
          //we have data in database 
          while ($rows = mysqli_fetch_assoc($res)) {
            //Using while loop to get all the data from database
            //and while loop will run as long as we have data in database

            //get indiviual Data
            $id=$rows['id'];
            $full_name=$rows['full_name'];
            $username=$rows['username'];
            //Display the values in our table
            ?>
<tr>
        <td><?php echo$id ?></td> 
        <td><?php echo$full_name ?></td>
        <td><?php echo$username ?></td>
        <td>
          <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>"class="btn-primary">Change Password</a>
          <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
          <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
        </td>
      </tr>

            <?php
          }
        } else {
          //we dont have data in database

        }
      }
      ?>
      
    </table>


  </div>
  <!-- Main Content Section Ends -->
  <?php include('partials/footer.php') ?>