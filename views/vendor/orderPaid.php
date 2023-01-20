<!-- VENDOR PAID ORDERS -->
<?php
include 'templates/vHomeHeader.php';
?>

<div class="container-fluid ">
    
    <div style="background-color: #fff; border-radius:10px;" class="m-5 p-4">

    <?php if (isset($_SESSION['orderPaid'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['orderPaid'];
            unset($_SESSION['orderPaid']);
            ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['approve'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['approve'];
            unset($_SESSION['approve']);
            ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['reject'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['reject'];
            unset($_SESSION['reject']);
            ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12 text-center">
        <h2 style="color:#6A0DAD;" class="mb-4">Orders Paid Incoming</h2>
        </div>
        <div class="col-3  text-center">
            <a  href="orderReject.php" style=" color:white;" class="btn btn-danger ">View Rejected Orders</a> 
        </div>
        <div class="col-3 text-center">
            
            <a  href="orderPaid.php" style="background-color:#6A0DAD; color:white;" class="btn inactiveLink2">View Incoming Orders</a> 
        </div>
        <div class="col-3  text-center">
            <a  href="orderOngoing.php" style="background-color:#6A0DAD; color:white;" class="btn ">View Sent Orders</a> 
        </div>
        <div class="col-3  text-center">
            <a  href="orderReceive.php" style="background-color:#6A0DAD; color:white;" class="btn ">View Received Orders</a> 
        </div>
    </div>
        <br>       
    <table style="background-color: rgba(255,255,255,0.1); border:solid 1px; box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);"  class="table text-center table-bordered">
        <thead style="color:#6A0DAD;">
        <tr class="tr">
            <th>No.</th>
            <th style="width: 7%;">ID No.</th>
            <th>Customer Name</th>
            <th style="width: 15%;">Address</th>
            <th>Contact</th>
            <th style="width: 20%;">Item Ordered</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th style="width: 10%;">Date Paid</th>
            <th style="width: 10%;">Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php 
        $vendorID = $_SESSION['vendorID'];
        $query = "SELECT * 
        FROM cart 
        JOIN userorder ON cart.orderID = userorder.orderID
        JOIN product ON cart.productID = product.productID
        WHERE product.vendorID='$vendorID' AND userorder.deleted='no' AND userorder.paid='yes' AND cart.completed='no' ORDER BY `cartID` DESC";
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
                $paymentDate = $cartRow['paymentDate'];
                $approved = $cartRow['approved'];
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
            <td><?php echo $paymentDate; ?></td>

            <td>    
            
            <?php 
            if($approved==''){ 
            ?>
                  <a href="validate.php?oID=<?php echo $orderID;?>" class="btn btn-danger" >Validate Payment</a>    
            <?php    
            }else{ 
            ?>
            <form method="post">      
            <input readonly type="hidden" name="cartID" value="<?=$cartID;?>">
            <button onclick="return confirm('Order Sent Confirmation?');" name="send" style="background-color:#6A0DAD;"  class="btn btn-primary">Order Sent?</button>
            </form>
            <?php 
            }
            ?>

            </td>
        </tr>
        
        <?php
                }
            }
            else
            {
                //Food not Added in Database
                echo "<tr> <td colspan='12' class='text-center'> No Incoming Paid Orders</td> </tr>";
            }

        ?>

        </tbody>
    </table>
    </div>
</div>

<?php
if (isset($_POST['send'])) {

    $cartid=$_POST['cartID'];

    date_default_timezone_set("Singapore");
    $sent_date = date("Y-m-d h:i:sa"); //Order DAte
    
    $queryCompleted = "UPDATE cart SET 
    completed='yes',
    compDate='$sent_date'
    WHERE cartID='$cartid'";
    
    if (mysqli_query($conn, $queryCompleted)) {
 
        $_SESSION['orderPaid'] = "<div style='color: green' class='alert alert-success text-center'>Order Sent Success! check Orders In Progress</div>";
        echo '
			<script>
			sweetAlert({
					title: "Order Sent!",
					text: "Check Your Check Your Orders Sent",
					type: "success",
				},

				function(){
							window.location.href ="orderPaid.php";
				});

				</script>
				';

    } else {
        $_SESSION['orderPaid'] = "<div style='color: red' class='alert alert-danger text-center'>Sorry! Update Order Status Failed</div>";
        echo '
        <script>
        sweetAlert({
                title: "Yikes! Update Order Sent Failure",
                text: "Get in contact with Admin",
                type: "warning",
            },

            function(){
                        window.location.href ="orderPaid.php";
            });

            </script>
            ';
      
        mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>

<?php

include 'templates/footer.php';
?>