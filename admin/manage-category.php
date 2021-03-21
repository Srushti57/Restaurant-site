
<?php include('partials/menu.php'); ?>

<!-- Main-content section -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Category</h1>
            <br><br>
            <?php 
            if(isset($_SESSION['add-category']))
            {
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            if(isset($_SESSION['delete-category']))
            {
                echo $_SESSION['delete-category'];
                unset($_SESSION['delete-category']);
            }
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update-category']))
            {
                echo $_SESSION['update-category'];
                unset($_SESSION['update-category']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['not-removed']))
            {
                echo $_SESSION['not-removed'];
                unset($_SESSION['not-removed']);
            }
            ?>
            <br><br>
            <a href="<?php echo SESSION_URL; ?>admin/add-category.php" class="btn-primary">Add Category</a><br/><br/>
            
            <table class="tbl_full">
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                </tr>

                <?php
                    //sql query
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title; ?></td>

                            <td>
                                <?php 
                                    //Check whether the image is present
                                    if($image_name!="")
                                    {
                                ?>
                                    <img src="<?php echo SESSION_URL;  ?>images/category/<?php echo $image_name?>" width="100px">
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
                                <a href="<?php echo SESSION_URL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SESSION_URL; ?>admin/delete-category.php?id=<?php echo $id; ?>& image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>

                            </td>
                        </tr>
                <?php

                        }
                    }
                    else
                    {
                        //We don have data 
                        //message will be shown inside table
                ?>
                    <tr>
                        <td colspan="6"><div class="error">No Category added</div></td>
                    </tr>

                <?php

                    }
                ?>
                
            </table>

        </div>
    </div>
<!--Main content ends-->

<?php include('partials/footer.php');?>