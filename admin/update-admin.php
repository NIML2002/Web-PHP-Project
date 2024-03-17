<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br /><br />
        <?php 
            //get the id of selected admin
                $id=$_GET['id'];

            //2.Create SQL query to get the details
            $sql="SELECT *FROM tbl_admin WHERE id=$id ";
        //execute the query
            $res=mysqli_query($conn,$sql);
        //check the whether the query is executed or not 
        if($res==TRUE){
            //check the whether the data is avaliable or not 
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get the detail
                echo"Admin Available";
                $row=mysqli_fetch_assoc($res);

                $full_name=$row['full_name'];
                $username=$row['username'];


            }else{

                header('location:'.SITEURL.'admin/manager-admin.php');
            }


        }
        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                           <input type="submit" name="submit" value="Update Admin" class="btn-secondary">    
                    </td>
                </tr>
            </table>


        </form>
    </div>



</div>





<?php 
    //check the whether the sumbit button is clicked or not 
    if( isset($_POST['submit']))
    {
        // echo "Button Clicked"
        //gett all values all from to update
      $id=$_POST['id'];
      $full_name=$_POST['full_name'];
      $username=$_POST['username'];
      //Create a Sql query to update admin
      $sql="UPDATE tbl_admin SET 
      full_name='$full_name',
      username ='$username' 
      WHERE id='$id'
      ";
      //execute the query
      $res =mysqli_query($conn,$sql);
      //check the whether the query succesfully or not 
      if($res==TRUE){

        //succes query execute and admin update
        $_SESSION['update']="<div class='success'>Admin Updated Succesfully.</div>";
        //redirect to manager admin page
        header('location:'.SITEURL.'admin/manager-admin.php');
      }
      else{
            //fail query executed and fail update admin
            $_SESSION['update']="<div class='error'>Admin Updated Failed.</div>";
            header('location:'.SITEURL.'admin/manager-admin.php');
      }
    }
?>

<?php include('partials/footer.php'); ?>