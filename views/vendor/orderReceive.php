<?php
include 'templates/vHomeHeader.php';
?>

<div class="container-fluid ">
    
    <div style="background-color: #fff; border-radius:10px;" class="m-5 p-4">

        <div class="row">
        <div class="col-12 text-center">
        <h2 style="color:#6A0DAD;" class="mb-4">Orders Completed</h2>
        </div>
        <div class="col-4 text-center">
            
            <a  href="orderPaid.php" style="background-color:#6A0DAD; color:white;" class="btn ">View Incoming Orders</a> 
        </div>
        <div class="col-4  text-center">
            <a  href="orderOngoing.php" style="background-color:#6A0DAD; color:white;" class="btn ">View Orders Sent</a> 
        </div>
        <div class="col-4  text-center">
            <a  href="orderReceive.php" style="background-color:#6A0DAD; color:white;" class="btn inactiveLink2">View Orders Received</a> 
        </div>
    </div>
        <br>       
    <table style="background-color: rgba(255,255,255,0.1); border:solid 1px; box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);"  class="table text-center table-bordered">
        <thead style="color:#6A0DAD;">
        <tr class="tr">
            <th>No.</th>
            <th style="width: 7%;">ID No.</th>
            <th>Payer Name</th>
            <th style="width: 15%;">Address</th>
            <th>Contact</th>
            <th>Item Name</th>
            <th style="width: 10%;" >Quantity</th>
            <th style="width: 10%;">Date Sent</th>
            <th style="width: 10%;">Customer Receive</th>
        </tr>
        </thead>
        <tbody>

        <?php 
        $vendorID = $_SESSION['vendorID'];

        $query = "SELECT * 
        FROM cart 
        JOIN userorder ON cart.orderID = userorder.orderID
        JOIN product ON cart.productID = product.productID
        WHERE product.vendorID='$vendorID' AND userorder.fulfilled='yes' AND cart.completed='yes' ORDER BY `cartID` DESC";
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
                $qty = $cartRow['quantity'];
                $prodPicture = $cartRow['prodPicture'];
                $prodName = $cartRow['prodName'];
                $sentDate = $cartRow['compDate'];
                $receiveDate = $cartRow['receiveDate'];
                // $discPrice = $cartRow['price'];
                // $disc = $cartRow['discount'];
                // $total = $cartRow['total'];
                $userid = $cartRow['userID'];
                $custRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE userID='$userid' "));
                $userName = $custRow['uName'];
                $userPhone = $custRow['userPhone'];
                $userAddress = $custRow['userLocation'];
                
                // $venRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$vendorID' "));
                // $vendorName = $venRow['vendorName'];
                // $categoryID = $prodRow['categoryID'];
                //         $cateRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `category` WHERE categoryID='$categoryID' "));
                //         $category = $cateRow['categoryName'];
                // $prodName = $prodRow['prodName'];
                // $prodPrice = $prodRow['prodPrice'];
                // $prodPicture = $prodRow['prodPicture'];
                // $inventoryNo = $prodRow['inventoryNo'];
                // $inStock = $prodRow['inStock'];
                // $discAmount = $prodRow['discAmount']; 
        ?>

        <tr class="tr2">
           <td ><?php echo $sn++; ?>) </td>
           <td ><?php echo $orderID; ?> </td>
           <td><?php echo $userName; ?></td>
           <td><?php echo $userAddress; ?></td>
           <td><?php echo $userPhone; ?></td>
          
            <td><?php echo $prodName; ?></td>
            <td><?php echo $qty; ?></td>
            <td style="color: green;"><?php echo $sentDate; ?></td>
            <td style="color: green;"><?php echo $receiveDate; ?></td>
        </tr>
        
        <?php
                }
            }
            else
            {
                //Food not Added in Database
                echo "<tr> <td colspan='12' class='text-center'>No Orders Fulfilled Yet</td> </tr>";
            }

        ?>

        </tbody>
    </table>
    </div>
</div>


<?php

include 'templates/footer.php';
?>