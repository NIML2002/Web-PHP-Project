<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update server</h1>
        <br><br>
        <?php 
            if(isset($_GET['id']))
            {
                //get the order detail
                //sql query to get the order details
                $id=$_GET['id'];
                $sql="SELECT *FROM tbl_order WHERE id=$id";
                //execute the query
                $res=mysqli_query($conn,$sql);
                //Count rows
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $food=$row['food'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $status=$row['status'];
                    $customer_name=$row['customer_name'];
            $customer_contact=$row['customer_contact'];
            $customer_email=$row['customer_email'];
            $customer_address=$row['customer_address'];
                }else{

                }
            }else{
                //redirect to manage order page
                header('location:'.SITEURL.'admin/manager-order.php');
            }
        
        ?>



        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b> </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><?php echo $price; ?> </td>
                </tr>


                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                
                

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){ echo "selected" ;} ?>value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){ echo "selected" ;} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){ echo "selected" ;} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){ echo "selected" ;} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>


                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <input type="text" name="customer_address" value="<?php echo $customer_address;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="Update Order">
                    </td>
                </tr>
            </table>
            <?php 
            if(isset($_POST['submit']))
            {
              //  echo 'clicked';
              //get all value from form
                    $id=$_POST['id'];
                    
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price* $qty; //total =price * qty
                   
                    $status=$_POST['status'];//Ordered ,On Delivery,Cancelled
                    $customer_name= $_POST['customer_name'];
                    $customer_contact=$_POST['customer_contact'];
                    $customer_email=$_POST['customer_email'];
                    $customer_address=$_POST['customer_address'];
                    //update the values
                    $sql2="UPDATE tbl_order SET
                    
                        qty=$qty,
                        total=$total,
                       
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                        WHERE id=$id
                    ";
                    //execute the query
                    $res2=mysqli_query($conn,$sql2);
                    //check whether update or not 
                    if($res2==true)
                    {
                        $_SESSION['update']="<div class ='success'>Order Update Successfully.</div>";
                        header('location:'.SITEURL.'admin/manager-order.php');
                    }else
                    {
                        $_SESSION['update']="<div class ='error'>Order Update Successfully.</div>";
                        header('location:'.SITEURL.'admin/manager-order.php');
                    }
            }
            ?>


        </form>

    </div>
</div> 


<?php include('partials/footer.php'); ?>