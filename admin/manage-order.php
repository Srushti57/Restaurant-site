
<?php include('partials/menu.php'); ?>

<!-- Main-content section -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Order</h1><br><br>

            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <br><br>
            <!-- <a href="#" class="btn-primary">Add Order</a><br/><br/> -->

            <table class='tbl_full'>
                <tr>
                    <th>SN</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order_date</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php

                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $total=$row['total'];
                            $order_date=$row['order_date'];
                            $status=$row['status'];
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address=$row['customer_address'];
                        
                    ?>
                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $food;?></td>
                                <td><?php echo $price;?></td>
                                <td><?php echo $qty;?></td>
                                <td><?php echo $total;?></td>
                                <td><?php echo $order_date;?></td>
                                <td>
                                    <?php
                                        if($status=="Ordered")
                                        {
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status=="On Delievery")
                                        {
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status=="Delivered")
                                        {
                                            echo "<label>$status</label>";
                                        }
                                     ?>
                                </td>
                                <td><?php echo $customer_name;?></td>
                                <td><?php echo $customer_contact;?></td>
                                <td><?php echo $customer_email;?></td>
                                <td><?php echo $customer_address;?></td>
                                <td>
                                    <a href="<?php echo SESSION_URL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                    <!-- <a href="<?php echo SESSION_URL; ?>admin/delete-order.php?id=<?php echo $id;?>&image_name=<?php echo  $image_name;?>" class="btn-danger">Delete Order</a> -->
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='12' class='fail'>No  Order Available</td></tr>";
                    }
                ?>
                
            </table>
            
        </div>
    </div>
<!--Main content ends-->

<?php include('partials/footer.php');?>