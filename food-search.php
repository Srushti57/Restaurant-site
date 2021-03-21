<?php include("partials-front/menu.php"); ?>

<!-- food search label section Starts-->
<section class="foodsearch text-center">
        <div class="container">
            <?php $search = $_POST['search']; ?>
            
            
                <h3>Food Search <a href="#"><?php echo $search;?></h3></a>
            
        </div>
</section>
<!-- food  search label section Ends-->

<<!-- food-menu  section Starts-->
<section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                    $search = $_POST['search'];
                    //Query to get data when searched a specific item
                    $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $description=$row['description'];
                            $image_name=$row['image_name'];
                            ?>

                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            if($image_name=="")
                                            {
                                                echo "<div class='fail'> Image not Found</div>";
                                                
                                            }
                                            else
                                            {
                                        ?>
                                            <img src="<?php echo SESSION_URL; ?>images/food/<?php echo $image_name;?>" class="img-responsive img-radius">

                                        <?php
                                            }
                                        ?>
                                    
                                    </div>
                                    <div class="food-desc">
                                        <p class="food-title"><?php echo $title; ?></p>
                                        <p class="food-price"><?php echo $price; ?>Rs.</p>
                                        <p class="food-detail"><?php echo $description; ?></p>
                                        <br />
                                        <input type="button" value="Order Now" class="btn btn-primary">
                                    </div>
                                    <div class="clear-fix"></div>
                                </div>

                            <?php
                        }
                    }
                    else
                    {
                        echo "<div class='fail'> Food not available</div>";
                    }
            ?>

            

            
            

            <div class="clear-fix"></div>
        </div>

    </section>
    <!--  food-menu section Ends-->


<?php include("partials-front/footer.php"); ?>
