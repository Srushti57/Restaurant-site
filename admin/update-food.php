<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <?php

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                //get data fromm database
                $sql = "SELECT * FROM tbl_food WHERE id= $id";

                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $title = $row['title'];
                        $price = $row['price'];  
                        $current_image = $row['image_name'];
                        $current_category = $row['category_id'];
                        $featured = $row['featured'];
                        $active = $row['active'];    
                    }
                }
                else
                {
                     //Session variable for error
                     $_SESSION['no-food-found'] = "<div class='fail'>No Food Found</div>";
                     header('location:'.SESSION_URL."admin/manage-food.php");
 
                }
            }
            else
            {
                header("location:".SESSION_URL."admin/manage-food.php");

            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td> <input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image!="")
                            {
                                //Display Image
                        ?>
                                    <img src="<?php echo SESSION_URL; ?>images/food/<?php echo $current_image;?>" width="100px">
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
                    <td>Category:</td>
                    <td>
                        <select name="category">
                        <?php
                            $sql3 = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res3= mysqli_query($conn, $sql3);
                            $count3=mysqli_num_rows($res3);
                            if($count3>0)
                            {
                                while($row3=mysqli_fetch_assoc($res3))
                                {
                                    $category_title = $row3['title'];
                                    $category_id = $row3['id'];

                                    ?>
                                        <option <?php if($current_category==$category_id){echo "Selected"; } ?> value="<?php echo $category_id;?>"><?php echo $category_title?></option>
                                    <?php
                                    
                                }
                            }
                            else
                            {
                                echo "<option value='0'>Cattegory not Found</option>";
                            }
                        ?>
                        </select>
                    </td>
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
                         <input type="submit" name="submit" value="Update" class="btn-secondary">
                     </td>
                 </tr>

            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $category = $_POST['category'];

                //Update image if selected
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {
                        //Rename the image
                        $ext = end(explode('.',$image_name));

                        $image_name = "Food_Image_".rand(0000,9999).".".$ext;

                        //1. Upload the image
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/".$image_name;
                        $upload = move_uploaded_file($src, $dst);
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload</div>";
                            header("location:".SESSION_URL."admin/manage-food.php");
                            die();
                        }
                        //2. remoove the current  image if any
                        if($current_image!="")
                        {
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);
                            if($remove==FALSE)
                            {
                                $_SESSION['not-removed'] = "<div class='fail'>Failed to change Image</div>";
                                header('location:'.SESSION_URL.'admin/manage-food.php');
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

                //Query to update data
                $sql2 = "UPDATE tbl_food SET
                        title='$title',
                        image_name = '$image_name',
                        category_id='$category',
                        featured='$featured',
                        active = '$active'
                        WHERE id=$id";

                $res2 =  mysqli_query($conn, $sql2);

                if($res2==TRUE)
                {
                    $_SESSION['update-food'] = "<div class='success'>Food Updated</div>";
                    header('location:'.SESSION_URL."admin/manage-food.php");
                }
                else
                {
                    $_SESSION['update-food'] = "<div class='fail'>Failed to Update Food</div>";
                    header('location:'.SESSION_URL."admin/manage-food.php");   
                }
            }



        ?>


    </div>
</div>


<?php include("partials/footer.php");?>