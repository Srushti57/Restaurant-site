<?php
    //Include constants.php
    include('../config/constants.php');
    //Check whether id and image name we got or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove physical if available
        if($image_name!="")
        {
            //Image available so remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove
            if($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class='fail'>FAiled to remove image</div>";
                header("location:".SESSION_URL."admin/manage-category.php");
                die();
            }
        }
        

        //Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);
        if($res==TRUE)
        {
            $_SESSION['delete-category'] = "<div class='success'>category removed Successfully</div>";
            header("location:".SESSION_URL."admin/manage-category.php");
        }
        else
        {
            $_SESSION['delete-category'] = "<div class='fail'>FAiled to remove category</div>";
            header("location:".SESSION_URL."admin/manage-category.php");
        }

        //redirect to manage-category page with message
    }
    else
    {
        //redirect to manage category
        header("location:".SESSION_URL."admin/manage-category.php");
    }
?>