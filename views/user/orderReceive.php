<?php
include 'templates/uHomeHeader.php';

$userID = $_SESSION['userID'];

$query = "SELECT * 
FROM cart 
JOIN userorder ON cart.orderID = userorder.orderID
JOIN product ON cart.productID = product.productID
WHERE userorder.userID='$userID' AND userorder.deleted='no' AND userorder.fulfilled='yes' AND cart.completed='yes' ORDER BY `cartID` DESC";
?>
<div class="container-fluid ">
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h2 class="sessionName">History</h2>
    </div>
</div>

<div style="background-color: #fff; border-radius:10px;" class="mx-5 p-4">
    <div class="row">
        <div class="col-12 text-center">
        <h2 style="color:#007dd6;" class="mb-4">Orders Received</h2>
        </div>

        <div class="col-4 text-center">
            <a  href="orderCancel.php" style="background-color:#007dd6; color:white;" class="btn ">View Cancelled Orders</a> 
        </div>

        <div class="col-4  text-center">
            <a  href="orderPay.php" style="background-color:#007dd6; color:white;" class="btn ">View Paid Orders</a>
        </div>

        <div class="col-4  text-center">
            <a  href="orderReceive.php" style="background-color:#007dd6; color:white;" class="btn inactiveLink2">View Received Orders</a> 
        </div>
    </div>

    <?php 
     $cartList = mysqli_query($conn, $query);
     //Count Rows to check whether we have foods or not
     $count = mysqli_num_rows($cartList);
    ?>

    <br>       
    <table style="background-color: rgba(255,255,255,0.1); box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);"  class="table text-center table-bordered">
        <thead style="color:#007dd6;">
        <tr class="tr">
        <th style="width: 3%;">No.</th>
            <th>Vendor</th>
            <th style="width: 17%;">Image</th>
            <th style="width: 17%;">Item Name</th>
            <th style="width: 7%;">Quantity</th>
            <th style="width: 10%;">Total</th>
            <th style="width: 7%;">ID No.</th>
            <th style="width: 10%;">Payment Date</th>
            <th style="width: 10%;">Receive Date</th>
        </tr>
        </thead>
        <tbody>

        <?php 
        // $query = "SELECT * FROM product WHERE vendorID='$vendorID' ORDER BY `productID` DESC";
        //Execute the qUery
        $cartList = mysqli_query($conn, $query);
        //Count Rows to check whether we have foods or not
        $count = mysqli_num_rows($cartList);
        //Create Serial Number VAriable and Set Default VAlue as 1
        $sn=1;

        if($count>0)
        {
            //We have food in Database
            //Get the Foods from Database and Display
            while($cartRow=mysqli_fetch_assoc($cartList))
            {
                //get the values from individual columns
                $cartID = $cartRow['cartID']; 
                $orderID = $cartRow['orderID']; 

                    $vendorID = $cartRow['vendorID'];
                    $venRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$vendorID' "));
                    $vendorName = $venRow['vendorName'];
                    
                    $paymentDate = $cartRow['paymentDate'];
                    $receiveDate = $cartRow['receiveDate'];
                $prodPicture = $cartRow['prodPicture'];
                $prodName = $cartRow['prodName'];
                $qty = $cartRow['quantity'];
                $total = $cartRow['total'];
                $status = $cartRow['completed'];


        ?>

        <tr class="tr2">
           <td ><?php echo $sn++; ?>. </td>
           <td ><?php echo $vendorName; ?></td>
           <td>
                <?php  
                    //CHeck whether we have image or not
                    if($prodPicture=="")
                    {
                        //WE do not have image, DIslpay Error Message
                        echo "<div class='error'>Image not Added.</div>";
                    }
                    else
                    {
                        //WE Have Image, Display Image
                        ?>
                        <img src="../../assets/images/product/<?php echo $prodPicture; ?>" width="60%" height="60%">
                        <?php
                    }
                ?>
            </td>
            <td><?php echo $prodName; ?></td>
            <td><?php echo $qty; ?></td>
            <td>RM<?php echo $total; ?></td>
            <td><?php echo $orderID; ?></td>
            <td><?php echo $paymentDate; ?></td>
            <td><?php echo $receiveDate; ?></td>
        </tr>
        
        <?php
                }
            }
            else
            {
                //Food not Added in Database
                echo "<tr> <td colspan='12' class='text-center'>No Orders Received </td> </tr>";
            }

        ?>

        </tbody>
    </table>
    </div>


<?php

include 'templates/footer.php';
?>