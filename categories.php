<?php include('partials-front/menu.php'); ?>

<!-- categories section Starts-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Food</h2>
            <?php

                //Query to get categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                $res = mysqli_query($conn, $sql);
                $count=mysqli_num_rows($res);
                if($count>0)
                {
                    //Category available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                     ?>
                        <!-- <a href="#"> -->
                        <a href="<?php echo SESSION_URL;?>category-food.php?category_id=<?php echo $id;?>">

                        <div class="box-3 float-container" >
                    <?php
                                if($image_name=="")
                                {
                                    echo "<div class='fail'>Image not there</div>";
                                }
                                else
                                {
                    ?>
                                    <img src="<?php echo SESSION_URL; ?>images/category/<?php echo $image_name;?>" height="380" alt="idli" class="img-responsive img-radius">

                    <?php
                                }
                    ?>
                            <h3 class="float-text"><?php echo $title;?></h3>
                        </div>

                        </a>

                    <?php
                    }
                }
                else
                {
                    echo "<div class='fail'>No category found</div>";
                }
            ?>
        
        
        </div>
        <div class="clear-fix"></div>

    </section>
    <!-- categories section Ends-->

<?php include('partials-front/footer.php'); ?>