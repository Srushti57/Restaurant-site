<?php

    include("../config/constants.php");
    //get id of admin to be deleted
    $id = $_GET['id'];
    //query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    //Execute the query
    $res = mysqli_query($conn, $sql);
    //Check  whether admin deleted or not
    if($res==TRUE)
    {
        //echo "Admin deleted";
        //MAke session variable to display message
        $_SESSION['delete'] = "Admin Deleted Succesfully";
       //Redirect to manage-admin page
        header('location:'.SESSION_URL.'admin/manage-admin.php');
    }
    else
    {
        //echo "failed";
        $_SESSION['delete'] = "FAiled to delete Admin";
        //Redirect to manage-admin page
         header('location:'.SESSION_URL.'admin/manage-admin.php');
    }


?>
