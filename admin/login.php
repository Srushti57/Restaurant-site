<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <br><br>

            <form action="" method="POST" class="middle">
                Username:<br>
                <input type="text" name="username" placeholder="Enter username"><br><br>

                Password:<br>
                <input type="password" name="password" placeholder="Enter password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

            </form>
            
        </div>
    </body>
</html>

<?php

    //check whether button is clicked
    if(isset($_POST['submit']))
    {
        
        //Get data
        $username = $_POST['username'];
        $password = $_POST['password'];

        //query 
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $_SESSION['login']="<div class='success'>Login Successfull</div>";
            header('location:'.SESSION_URL.'admin/');
        }
        else
        {
            $_SESSION['login']="<div class='fail'>USername  OR Password not match</div>";
            header('location:'.SESSION_URL.'admin/login.php');
        }
    }
?>