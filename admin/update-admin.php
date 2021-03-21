<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
        //Get id of admin to be updated
            $id = $_GET['id'];
        //Query to getthe details
            $sql = "SELECT  * FROM tbl_admin WHERE id=$id";
        //Execute the query
            $res = mysqli_query($conn, $sql);
        //To check whwther query executed or not
            if($res == TRUE)
            {
                $count=mysqli_num_rows($res);
                if($count==1)
                    {
                        //Get the details
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                else
                {
                    //redirect to managea-adminn
                    header('location:'.SESSION_URL.'admin/manage-admin.php');
                    
                }
                                
            }

        ?>

        <form action="" method="POST">
        <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td><input type="text" name="full_name" placeholder="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="<?php echo $username; ?>"></td>
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

        //check whett=her button is clicked or not
        if(isset($_POST['submit']))
        {
            //Get the values from form to update
            $id= $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            //query to  update
            $sql = "UPDATE tbl_admin SET
                    full_name='$full_name',
                    username='$username'
                    WHERE id=$id";

            //execute query
            $res = mysqli_query($conn, $sql);

            //check the  query
            if($res==TRUE)
            {
                $_SESSION['update']="Admin Updated";
                header('location:'.SESSION_URL.'admin/manage-admin.php');
            }
            else{
                $_SESSION['update']="Failed to  update admin";
                header('location:'.SESSION_URL.'admin/manage-admin.php');
            }
        }
?>


<?php include('partials/footer.php');?>



