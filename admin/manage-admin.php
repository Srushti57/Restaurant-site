
<?php include('partials/menu.php'); ?>

<!-- Main-content section -->
    <div class="main-content">
        <div class="wrapper">
            <div class="add-admin">
            <h1> Manage Admin</h1><br/>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user-notfound']))
                {
                    echo $_SESSION['user-notfound'];
                    unset($_SESSION['user-notfound']);
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
                if(isset($_SESSION['not-change']))
                {
                    echo $_SESSION['not-change'];
                    unset($_SESSION['not-change']);
                }
                if(isset($_SESSION['not-match']))
                {
                    echo $_SESSION['not-match'];
                    unset($_SESSION['not-match']);
                }
                

            ?>
            <br><br><br>
            <a href="add-admin.php" class="btn-primary">Add admin</a><br/><br/>
            </div>
            <table class="tbl_full">
                <tr>
                    <th>Sr No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>

                <?php

                    $sql = "SELECT * from tbl_admin";
                    $res= mysqli_query($conn, $sql);

                    $sn=1;
                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        if($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //get indiviual value
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                            //DISPLAY data in our table
                            ?>
                            <tr>
                                
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <!-- <a href="#" class="btn-secondary">Update Admin</a> -->
                                    <a href="<?php echo SESSION_URL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SESSION_URL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SESSION_URL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>

                                </td>
                            </tr>


                            <?php
                            }
                        }
                    }
                ?>
                
                
                
            </table>
            
        </div>
    </div>
<!--Main content ends-->

<?php include('partials/footer.php');?>