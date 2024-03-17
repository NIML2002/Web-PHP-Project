<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />
        <?php 
      if(isset($_SESSION['add']))//check whether the session is set of not
      {
        echo $_SESSION['add'];//Displaying Session Message if set
        unset($_SESSION['add']);//REmove Session Message
      }
      
    ?>
    
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>FullName :</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>UserName :</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your UserName">
                    </td>
                </tr>
                <tr>
                    <td>PassWord</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>


<?php
//process the value from Form and save it to data base

//Check wether the button is  clicked or not 
if (isset($_POST['submit'])) {
    //button clicked

    //Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encrytion with md5
    //Sql query to save data into database
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
       ";


    //3 execute query and save data in data base

    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    //4 check wether the (query is executed ) data is inserted or not and display appropriate message 
    if ($res == TRUE) {
        //data inserted
        // echo "data inserted";
        //create a session variable to display message
        $_SESSION['add']='Admin Added Succesfully';
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manager-admin.php');
    } else {
        //failed inserted
       // echo "faile to insert data";
       $_SESSION['add']='Faile to add Addmin';
        //Redirect Page to Add Admin
        header("location:".SITEURL.'admin/add-admin.php');
    }
}

?>