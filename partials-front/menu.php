<?php include("config/constants.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar  section Starts-->
    <section class="navbar">
        <div class="container">
            <div class="logo">
               <a href="<?php echo SESSION_URL;?>"> <img src="images/logo1.png" alt="logo" class="img-responsive"></a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li><a href="<?php echo SESSION_URL;?>">Home</a></li>
                    <li><a href="<?php echo SESSION_URL;?>categories.php">Categories</a></li>
                    <li><a href="<?php echo SESSION_URL;?>food.php">Food</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="clear-fix"></div>
        </div>
    </section>
    <!-- Navbar  section Ends-->