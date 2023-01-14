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
                $sql = "SELECT * FROM `userorder` WHERE paid='yes' AND approved='yes'";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            <h4>Total Payed Orders</h4>
            </div>
        </div>

        <div class=" col-sm-4 text-center" > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $sql = "SELECT * FROM `userorder` WHERE deleted='no' AND paid='yes' AND approved='' ";
                //Execute Query
                $count = mysqli_num_rows(mysqli_query($conn, $sql));
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            <h4>Total Order for Validation</h4>
            </div>
        </div>

                 <div class=" col-sm-4 text-center" > 
                    <div class=" boxStyle">            
                    <?php 
                        //Sql Query 
                        $Join = "SELECT 'Today' as date, count(orderID) as Unpaid FROM userorder 
                        WHERE deleted='no' AND paid='no' 
                        AND orderDate > DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
                        //Execute Query
                        $res = mysqli_query($conn, $Join);
                        $row = mysqli_fetch_assoc($res);
                        $countUnpaid = $row['Unpaid'];
        
                        if($countUnpaid == null )
                        {
                            $countUnpaid = 0;
                        }
                    ?>

                    <h1><?php echo $countUnpaid; ?></h1>
                    <br />
                    <h4>Today Unpaid Orders</h4>
                    </div>
                </div>

                 <div class=" col-sm-4 text-center" > 
                    <div class=" boxStyle">            
                    <?php 
                        //Sql Query 
                        $Join = "SELECT 'Today' as date, count(orderID) as Unpaid FROM userorder 
                        WHERE deleted='no' 
                        AND paid='yes' AND approved=''
                        AND orderDate > DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
                        //Execute Query
                        $res = mysqli_query($conn, $Join);
                        $row = mysqli_fetch_assoc($res);
                        $countUnpaid = $row['Unpaid'];
        
                        if($countUnpaid == null )
                        {
                            $countUnpaid = 0;
                        }
                    ?>

                    <h1><?php echo $countUnpaid; ?></h1>
                    <br />
                    <h4>Today Order for Validation</h4>
                    </div>
                </div>

                <div class=" col-sm-4 text-center" > 
                    <div class=" boxStyle">            
                    <?php 
                        //Sql Query 
                        $Join = "SELECT 'Today' as date, count(orderID) as paid FROM userorder 
                        WHERE deleted='no' 
                        AND paid='yes' AND approved='yes'
                        AND orderDate > DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
                        //Execute Query
                        $res = mysqli_query($conn, $Join);
                        $row = mysqli_fetch_assoc($res);
                        $countPaid = $row['paid'];
        
                        if($countPaid == null )
                        {
                            $countPaid = 0;
                        }
                    ?>

                    <h1><?php echo $countPaid; ?></h1>
                    <br />
                    <h4>Today Paid Orders</h4>
                    </div>
                </div>
            
        

        <div class=" col-sm-6 text-center " > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $Join = "SELECT SUM(total) AS total 
                FROM cart 
                JOIN userorder 
                ON cart.orderID = userorder.orderID
                WHERE userorder.deleted='no' AND userorder.paid='yes' AND userorder.approved='yes' AND cart.completed='yes'";
                
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
            <h4>Alltime Completed Revenue</h4>
            </div>
        </div>
        <div class=" col-sm-6 text-center " > 
            <div class=" boxStyle">            
            <?php 
                //Sql Query 
                $queryJoin = "SELECT 'Today' as date, sum(total) as total FROM cart
                JOIN userorder 
                ON cart.orderID = userorder.orderID
                WHERE userorder.deleted='no' AND userorder.paid='yes' AND userorder.approved='yes' AND cart.completed='yes'
                AND userorder.orderDate > DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
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
            <h4>Today Completed Revenue</h4>
            </div>
        </div>

    </div>
</div>



<?php
include 'templates/footer.php';
?>

