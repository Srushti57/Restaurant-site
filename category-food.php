<?php include("partials-front/menu.php"); ?>

<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        $sql = "SELECT title from tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn,  $sql);
        $row = mysqli_fetch_assoc($res);

        $category_title = $row['title'];

    }
    else
    {
        header('location:'.SESSION_URL);
    }

?>
<!-- category label section Starts-->
<section class="foodsearch text-center">
        <div class="container">
                <h3>CAtegory Search <a href="#"><?php echo $category_title;?></a></h3>
            
        </div>
</section>
<!-- category label section Ends-->


<!-- categories section Starts-->
<section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Food</h2>
            <?php

                    //Sql Query 
                    $sql2 ="SELECT * FROM tbl_food WHERE category_id=$category_id";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);

                    if($count2>0)
                    {
                        while($row2=mysqli_fetch_assoc($res2))
                        {
                            $title = $row2['title'];
                            $description = $row2['description'];
                            $price = $row2['price'];
                            $image_name = $row2['image_name'];
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
                        echo "<div class='fail'>Food not available</div>";
                    }

            ?>
            <!-- <a href="#">
            <div class="box-3 float-container" >
                <img src="images/idli1.jpg" height="380" alt="idli" class="img-responsive img-radius">
                <h3 class="float-text">Idli</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container" >
                <img src="images/masala1.jpg" height="380" alt="dosa" class="img-responsive img-radius">
                <h3 class="float-text">Dosa</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container" >
                <img src="images/appam.jpg" height="380" alt="appam" class="img-responsive img-radius">
                <h3 class="float-text">Appam</h3>
            </div>
             <div class="clear-fix"></div>
            </a> -->
            <div class="clear-fix"></div>

        </div>
    </section>
    <!-- categories section Ends-->

<?php include("partials-front/footer.php"); ?>
