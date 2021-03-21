
<?php include('partials/menu.php'); ?>

<!-- Main-content section -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Food</h1><br><br>
            <?php
                if(isset($_SESSION['food']))
                {
                    echo $_SESSION['food'];
                    unset($_SESSION['food']);
                }
                if(isset($_SESSION['not-present']))
                {
                    echo $_SESSION['not-present'];
                    unset($_SESSION['not-present']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['nodelete']))
                {
                    echo $_SESSION['nodelete'];
                    unset($_SESSION['nodelete']);
                }
                if(isset($_SESSION['not-removed']))
                {
                    echo $_SESSION['not-removed'];
                    unset($_SESSION['not-removed']);
                }
                if(isset($_SESSION['update-food']))
                {
                    echo $_SESSION['update-food'];
                    unset($_SESSION['update-food']);
                }



            ?>
            <br><br>
            <a href="<?php echo SESSION_URL;?>admin/add-food.php" class="btn-primary">Add Food</a><br/><br/>
            <table class="tbl_full">
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                    //Query to get data from database
                    $sql = "SELECT * FROM tbl_food";

                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id= $row['id'];
                            $title= $row['title'];
                            $price= $row['price'];
                            $image_name = $row['image_name'];
                            $featured= $row['featured'];
                            $active= $row['active'];
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                <?php 
                                    //Check whether the image is present
                                    if($image_name!="")
                                    {
                                ?>
                                    <img src="<?php echo SESSION_URL;  ?>images/food/<?php echo $image_name?>" width="100px">
                                <?php
                                    }
                                    else
                                    {
                                        echo "<div class='fail'>Image not added</div>";
                                    }
                                ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SESSION_URL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SESSION_URL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo  $image_name;?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>

                        <?php
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='7'>Food not added yet</td></tr>";
                    }

                ?>
                

            </table>
        </div>
    </div>
<!--Main content ends-->

<?php include('partials/footer.php');?>