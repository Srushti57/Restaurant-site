   <?php include("partials-front/menu.php"); ?>

    <!-- food search  section Starts-->
    <section class="foodsearch text-center">
        <div class="container">
                <form action="<?php echo SESSION_URL;?>food-search.php" method="POST">
                    <input type="search" name="search" placeholder="Search food here..">
                    <input type="submit" value="search" class="btn btn-primary">
                </form>
            
        </div>
    </section>
    <!-- food  search  section Ends-->
    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- categories section Starts-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Food</h2>
            <?php

                //Query to get categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' and featured='Yes' LIMIT 3";

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

    <!-- food-menu  section Starts-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //Query to get categories from database
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' and featured='Yes' LIMIT 4";

                $res2 = mysqli_query($conn, $sql2);
                $count2=mysqli_num_rows($res2);
                if($count2>0)
                {
                    //Category available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];

                     ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                        if($image_name=="")
                                        {
                                            echo "<div class='fail'>Image not there</div>";
                                        }
                                        else
                                        {
                            ?>
                                            <img src="<?php echo SESSION_URL; ?>images/food/<?php echo $image_name;?>"  alt="idli" class="img-responsive img-radius">

                            <?php
                                        }
                            ?>

                            </div>
                            <div class="food-desc">
                                <p class="food-title"><?php echo $title;?></p>
                                <p class="food-price"><?php echo $price;?>Rs.</p>
                                <p class="food-detail"><?php echo $description;?></p>
                                <br />
                                <!-- <input type="button" value="Order Now" class="btn btn-primary"> -->
                                <a href="<?php echo SESSION_URL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                                <!-- <div class="clear-fix"></div> -->
                        </div>
                                               
                    
                        <!-- </a> -->

                    <?php
                    }
                }
                else
                {
                    echo "<div class='fail'>No Food found</div>";
                }
            ?>
            
            <div class="clear-fix"></div>
        </div>
    
        <p class='text-center'>
            <a href="<?php echo SESSION_URL; ?>food.php">See All food</a>
        </p>

    </section>
    <!--  food-menu section Ends-->

   <?php include("partials-front/footer.php");  ?> 