<?php
include 'templates/aHomeHeader.php';
?>
<!-- margin y axis (top/bottom) -->
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Welcome <?=$_SESSION['adminName'];?></h1>
    </div>
</div>
<?php
if (isset($_SESSION['loginAdmin'])) {
    echo $_SESSION['loginAdmin'];
    unset($_SESSION['loginAdmin']);
}
?>


<div class="container">
    <div class="row "  >
        <div class=" col-sm-4 text-center" > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $sql = "SELECT * FROM `user`";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
                //Count Rows
            ?>

            <h1><?php echo $count; ?></h1>
            <br >
            <h4>Total Users</h4>
            </div>
        </div>
        <div class=" col-sm-4 text-center" > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $sql = "SELECT * FROM `vendor`";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            <h4>Total Vendors</h4>
            </div>
        </div>
        <div class=" col-sm-4 text-center" > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $sql = "SELECT * FROM `admin`";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            <h4>Total Admins</h4>
            </div>
        </div>
        <div class=" col-sm-4 text-center" > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $sql = "SELECT * FROM `product`";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            <h4>Total Products</h4>
            </div>
        </div>
        <div class=" col-sm-4 text-center" > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $sql = "SELECT * FROM `userorder` WHERE deleted='no'";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            <h4>Alltime Product Orders</h4>
            </div>
        </div>
        <div class=" col-sm-4 text-center" > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $sql = "SELECT * FROM `userorder` WHERE paid='yes'";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            <h4>Today Product Orders</h4>
            </div>
        </div>
        <div class=" col-sm-4 text-center" > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $sql = "SELECT * FROM `userorder` WHERE paid='yes'";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            <h4>Total Payed Orders</h4>
            </div>
        </div>
        <div class=" col-sm-4 text-center " > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $Join = "SELECT SUM(total) AS total 
                FROM cart 
                JOIN userorder 
                ON cart.orderID = userorder.orderID
                WHERE userorder.deleted='no' AND userorder.paid='yes'";
                
                $res = mysqli_query($conn, $Join);
                $row = mysqli_fetch_assoc($res);
                $sum = $row['total'];

                if($sum == null )
                {
                    $sum = 0;
                }
            ?>

            <h1>RM<?php echo $sum; ?></h1>
            <br />
            <h4>Alltime Revenue</h4>
            </div>
        </div>
        <div class=" col-sm-4 text-center " > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $queryJoin = "SELECT 'Today' as date, sum(total) as total FROM cart
                JOIN userorder 
                ON cart.orderID = userorder.orderID
                WHERE userorder.deleted='no' AND userorder.paid='yes' AND userorder.orderDate > DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
                //Execute Query
                $res = mysqli_query($conn, $queryJoin);
                $row = mysqli_fetch_assoc($res);
                $sum = $row['total'];

                if($sum == null )
                {
                    $sum = 0;
                }
       
            ?>

            <h1>RM<?php echo $sum; ?></h1>
            <br />
            <h4>Today Revenue</h4>
            </div>
        </div>

    </div>
</div>

</div>
<div style="margin-top: 70px ;">
</div>


<?php
include 'templates/footer.php';
?>

