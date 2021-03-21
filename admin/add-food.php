<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description"  cols="30" rows="5"></textarea></td>
                    
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >
                            <?php
                                //Create query to get category from database
                                //Sql query to get category from DB which are active
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if($count>0)
                                {
                                    //category available
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //Get data from DB
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    
                                        <?php
                                    }
                                }
                                else
                                {
                                    //no  category
                                    ?>
                                    <option value="0">No category</option>
                                    <?php
                                }
                            

                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class=btn-secondary>
                    </td>
                </tr>

            </table>
        </form>
                    
        <?php
            //Check whwther button is clicked
            if(isset($_POST['submit']))
            {
                //Get the data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                
                //For radio options like featured and active
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }
                //Upload the image
                // Check whether chhose file button is clicked
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    //Check  whether image was selected
                    if($image_name!="")
                    {
                        //Image was selected 
                        //A. Rename the immage
                        $ext =end(explode('.',$image_name));

                        $image_name = "Food_Image_".rand(0000,9999).".".$ext;
                        //B. Upload the  image
                        //Get  the src and destination path
                        $src = $_FILES['image']['tmp_name'];
                        $dest = "../images/food/".$image_name;
                        //Finally upload
                        $upload = move_uploaded_file($src, $dest);

                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='fail'>failed to upload</div>";
                            header('location:'.SESSION_URL."admin/add-food.php");
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = "";
                }

                //Insert into  the DAtabase
                //Sql  query 
                $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                        ";
                $res2 = mysqli_query($conn, $sql2);

                if($res2==TRUE)
                {
                    //Foood Added succesfully
                    $_SESSION['food'] = "<div class='success'>Food added Successfully</div>";
                    header('location:'.SESSION_URL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['food'] = "<div class='fail'>Failed to Add food</div>";
                    header('location:'.SESSION_URL.'admin/manage-food.php');

                }


            }
                                
        ?>
    </div>
</div>
<?php include("partials/footer.php"); ?>