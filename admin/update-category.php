<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php 

            //check  whether weget id or not
            if(isset($_GET['id']))
            {
                //Get the data
                $id = $_GET['id'];
                //Sql query to get all the data
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //Get  the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Session variable for error
                    $_SESSION['no-category-found'] = "<div class='fail'>No Category Found</div>";
                    header('location:'.SESSION_URL."admin/manage-category.php");

                }
            }
            else
            {
                header("location:".SESSION_URL."admin/manage-category.php");
            }
        ?>


            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                    </tr>
                    <tr>
                        <td>Current image: </td>
                        <td>
                            <?php
                                if($current_image!="")
                                {
                                    //Display image
                            ?>
                                    <img src="<?php echo SESSION_URL;?>images/category/<?php echo $current_image;?>" width="120px">
                            <?php
                                }
                                else
                                {
                                    echo "<div class='fail'>Image not found</div>";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td><input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes</td>
                        <td><input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No</td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td><input <?php if($active=="Yes"){echo "checked";} ?>  type="radio" name="active" value="Yes">Yes</td>
                        <td><input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No</td>
                    </tr>
                    <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class=btn-secondary>
                    </td>
                </tr>

                </table>
            </form>

            <?php
                //Check whether button clicked
                if(isset($_POST['submit']))
                {
                    //Get data from form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];
                    //Update Image if selected
                    //Check whether image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        //Get the image details
                        $image_name = $_FILES['image']['name'];
                        //Check whetther image is available
                        if($image_name!="")
                        {
                            //Image available
                            //1. Upload the new Image
                            //Auto rename of image

                            //Get The extension of our image eg:'jpg', 'png'
                            $ext = end(explode('.', $image_name));
                            //New name to image
                            $image_name = "Food_Category_".rand(000,999).".".$ext;
    
    
                            $source_path = $_FILES['image']['tmp_name'];
                            $dest_path = "../images/category/".$image_name;
    
                            //finally upload
                            $upload = move_uploaded_file($source_path, $dest_path);
    
                            //Check whethher uploaded or not
                            if($upload == FALSE)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to upload</div>";
                                header("location:".SESSION_URL."admin/manage-category.php");
                                die();
                            }
                            //2. Remove the current Image if available
                            if($current_image!="")
                            {
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);
                                //Check whether removed or not
                                if($remove==FALSE)
                                {
                                    $_SESSION['not-removed'] = "<div class='fail'>Failed to change Image</div>";
                                    header('location:'.SESSION_URL.'admin/manage-category.php');
                                    die();
                                }
                            }
                            
                        }
                        else
                        {
                            $image_name = $current_image;

                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    //Query for updating database
                    $sql2 = "UPDATE tbl_category SET 
                            title='$title',
                            image_name = '$image_name',
                            featured='$featured',
                            active = '$active'
                            WHERE id=$id
                            ";
                    $res2 = mysqli_query($conn, $sql2);
                    //redirect
                    if(res2==TRUE)
                    {
                        $_SESSION['update-category'] = "<div class='success'>Category Updated</div>";
                        header('location:'.SESSION_URL."admin/manage-category.php");
                    }
                    else
                    {
                        $_SESSION['update-category'] = "<div class='fail'>Failed to Update Category</div>";
                        header('location:'.SESSION_URL."admin/manage-category.php");   
                    }
                    
                }

            ?>
    </div>
</div>

<?php include('partials/footer.php');?>