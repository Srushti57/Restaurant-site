<?php

    //ADd constants.php
    include("../config/constants.php");
    //Check whther id and imagename is selected
    if(isset($_GET['id'])AND isset($_GET['image_name']))
    {
        //1. GEt id and image name for removing
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if present
        if($image_name!='')
        {
            //Image is present
            $path = "../images/food/".$image_name;

            $remove= unlink($path);

            if($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class='fail'>Failed to remove the image</div>";
                header('location:'.SESSION_URL."admin/manage-food.php");
                die();
            }
        }
        // else
        // {
        //     $_SESSION['upload'] = "<div class='fail'>Image not presnt</div>";
        //     header('location:'.SESSION_URL."admin/manage-food.php");
        // }

        //3. Remove data from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        //4. Redirect
        if($res==TRUE)
        {
            
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SESSION_URL."admin/manage-food.php");
        }
        else
        {
            $_SESSION['nodelete'] = "<div class='fail'>Failed to delete Food</div>";
            header('location:'.SESSION_URL."admin/manage-food.php");
        }

    }
    else
    {
        $_SESSION['not-present'] = "<div class='fail'>Unauthorized access</div>";
        header('location:'.SESSION_URL."admin/manage-food.php");
    }
?>