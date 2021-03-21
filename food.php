<?php include("partials-front/menu.php"); ?>

<section class="foodsearch text-center">
        <div class="container">
                <form action="<?php echo SESSION_URL;?>food-search.php" method="POST">
                    <input type="search" name="search" placeholder="Search food here..">
                    <input type="submit" value="search" class="btn btn-primary">
                </form>
            
        </div>
</section>

<!-- food-menu  section Starts-->
<section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //Query to get categories from database
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes'";

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
                                <input type="button" value="Order Now" class="btn btn-primary">
                            </div>
                                <!-- <div class="clear-fix"></div> -->
                        </div>
                                               
                    
                        </a>

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
    
        

    </section>

<?php include("partials-front/footer.php"); ?>
