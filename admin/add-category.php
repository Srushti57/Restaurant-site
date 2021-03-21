<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add-category']))
            {
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Category title">
                </td>
                
                </tr>
                <br>

                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class=btn-secondary>
                    </td>
                </tr>

            </table>
        
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //Get values from form
                $title = $_POST['title'];

                //to get value from radio type
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    //set default
                    $featured = "No";
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    //set default
                    $active = "No";
                }

                //Check  whether the image was selected or not and set the value for the image name accordingly
                // print_r($_FILES['image']);

                // die();

                if(isset($_FILES['image']['name']))
                {
                    //Upload the image
                    //To upload the we need image_name, sourcepath and destpath
                    $image_name = $_FILES['image']['name'];

                    //Upload only  if image name is present
                    if($image_name!="")
                    {
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
                            header("location:".SESSION_URL."admin/add-category.php");
                            die();
                        }
                    }
                }
                else
                {
                    //Dont upload set the  image name as blank
                    $image_name = "";
                }

                //SQL query
                $sql = "INSERT INTO tbl_category SET 
                        title= '$title' ,
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'  ";
                //Execute query
                $res = mysqli_query($conn, $sql);
                //check query
                if($res==TRUE)
                {
                    $_SESSION['add-category'] = "<div class='success'> Category ADDed Successfully</div>";
                    header("location:".SESSION_URL."admin/manage-category.php");
                }
                else
                {
                    $_SESSION['add-category'] = "<div class='error'> Failed to add Category</div>";
                    header("location:".SESSION_URL."admin/add-category.php");
                }

            }
        
        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>
