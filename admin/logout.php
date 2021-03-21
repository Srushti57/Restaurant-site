<?php
    //Include constatnts.php
    include('../config/constants.php');
    //destroy session
    session_destroy();
    //redirect
    header('location:'.SESSION_URL.'admin/login.php');

?>