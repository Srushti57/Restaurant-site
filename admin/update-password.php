<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1><br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>
        <form action="" method="POST">
        <table class="tbl-30">
                <tr>
                    <td>Current Password </td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
               
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
//check whether button is clicked
    if(isset($_POST['submit']))
    {
        //get the data
        $id = $_POST['id'];
        $current_password= $_POST['current_password'];
        $new_password= $_POST['new_password'];
        $confirm_password= $_POST['confirm_password'];

        //query
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //execute query
        $res = mysqli_query($conn, $sql);

        //check the execution
        if($res==TRUE)
        {
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                if($new_password==$confirm_password)
                {
                    $sql2 = "UPDATE tbl_admin SET 
                            password='$new_password'";
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==TRUE)
                    {
                        $_SESSION['change-pwd'] = 'Password Changed Succesfully';
                        header('location:'.SESSION_URL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['not-change'] = 'Failed to change paswword';
                        header('location:'.SESSION_URL.'admin/manage-admin.php');

                    }
                }
                else{
                    $_SESSION['not-match'] = 'Password Not match';
                    header('location:'.SESSION_URL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['user-notfound'] = "User not found";
                header('location:'.SESSION_URL.'admin/manage-admin.php');
            }
        }

    }

?>

<?php include('partials/footer.php'); ?>