<?php
include 'templates/uHomeHeader.php';
?>

<div class="container-fluid " style="width: 77%;">
    
    <div style="background-color: #fff; border-radius:10px;" class="m-5 p-4">

    <?php if (isset($_SESSION['payError'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['payError'];
            unset($_SESSION['payError']);
            ?>
    </div>
    <?php endif; ?>

    

    <h2 style="color:#007dd6;" class="text-center ">Payment</h2>
    
    <br>       
    <table  class="table text-center table-borderless">
        <thead style="color:#007dd6;">
        <tr>
            <th style="width: 3%;">No.</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Vendor Name</th>
            <th>Bank Name</th>
            <th>Bank No.</th>
            <th style="width: 9%;">ID No.</th>
            <th>Total</th>
            <th>Validation</th>
           
        </tr>
        </thead>
        <tbody>

        <?php 
        $userID = $_SESSION['userID'];
        $sum = 0;
        $query = "SELECT * 
        FROM cart 
        JOIN userorder 
        ON cart.orderID = userorder.orderID
        WHERE userorder.userID='$userID' AND userorder.deleted='no' AND userorder.paid='no' ORDER BY `cartID` DESC";

        // $query = "SELECT * FROM product WHERE vendorID='$vendorID' ORDER BY `productID` DESC";
        //Execute the qUery
        $cartList = mysqli_query($conn, $query);
        //Count Rows to check whether we have foods or not
        $count = mysqli_num_rows($cartList);
        //Create Serial Number VAriable and Set Default VAlue as 1
        $sn=1;
        $x=0;
        $y=0;

        if($count>0)
        {
            
            //We have food in Database
            //Get the Foods from Database and Display
            while($cartRow=mysqli_fetch_assoc($cartList))
            {
                //get the values from individual columns
                $cartID = $cartRow['cartID'];
                $orderID = $cartRow['orderID'];
                $approved = $cartRow['approved'];
                $proof = $cartRow['proof'];

                if(empty($proof)){
                    $x++;
                }
                if($approved == 'no'){
                    $y++;
                }

                $productID = $cartRow['productID'];
                    $prodRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `product` WHERE productID='$productID' "));
                    
                    $vendorID = $prodRow['vendorID'];
                    $venRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$vendorID' "));
                    $vendorName = $venRow['vendorName'];
                    $bankName = $venRow['bankName'];
                    $bankNo = $venRow['bankNo'];
                    $categoryID = $prodRow['categoryID'];
                            $cateRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `category` WHERE categoryID='$categoryID' "));
                            $category = $cateRow['categoryName'];
                    $prodName = $prodRow['prodName'];
                    $prodPrice = $prodRow['prodPrice'];
                    $prodPicture = $prodRow['prodPicture'];
                    $inventoryNo = $prodRow['inventoryNo'];
                    $inStock = $prodRow['inStock'];
                    $discAmount = $prodRow['discAmount']; 
                    
                $discPrice = $cartRow['price'];
                $qty = $cartRow['quantity'];
                $disc = $cartRow['discount'];
                $total = $cartRow['total'];

                $sum += $total;
                $sum = number_format($sum, 2);
        ?>

        <tr>
           <td ><?php echo $sn++; ?>. </td>
           <td><?php echo $prodName; ?></td>
           <td><?php echo $qty; ?></td>
           <td ><?php echo $vendorName; ?></td>
           <td ><?php echo $bankName; ?></td>
           <td ><?php echo $bankNo; ?></td>
           <td style="color: #007dd6;"><?php echo $orderID ?> </td>
           <td style="color: #007dd6;">RM<?php echo $total; ?></td>
           
           <td >

            <?php 
            if(empty($proof)){
            ?>
                <a href="proof.php?oID=<?php echo $orderID;?>" style=" color:white;" class="btn btn-primary" >New Upload</a>     
            
            <?php } else if($approved == 'no'){ ?>
                
                <a href="proof.php?oID=<?php echo $orderID;?>" style=" color:white;" class="btn btn-danger" >Reupload Needed</a>
            
            <?php }else{?>

                <a href="proof.php?oID=<?php echo $orderID;?>" style=" color:white;" class="btn btn-success" >Update Upload</a>

            <?php }?>

           </td>

           
        </tr>
        
        <?php
                }
            }
            else
            {
                //Food not Added in Database
                echo "<tr> <td colspan='12' class='text-center'>Your Cart Is Empty. </td> </tr>";
            }

        ?>


        </tbody>
    </table>

    <div class="row " >

    <div class="col-6 text-center">

        <a  href="userCart.php" style="background-color:#007dd6; color:white;" class="btn ">Back To Cart</a> 
    </div>
    <div class="col-6  text-center">

    <?php 
     if($y > 0){
    ?>
    <button style=" color:007dd6;"  class="btn btn-link inactiveLink">You Have <?=$y?> More Reupload</button>         
    
    <?php } else if($x == 0){ ?>
        
        <form method="post">
            <button onclick="return confirm('Are you sure you uploaded payments?');" name="pay" style="background-color:#007dd6; color:white;"  class="btn hover">Confirm Payments?</button>         
            </form>
        
    <?php }else{?>
            
            <button style=" color:007dd6;"  class="btn btn-link inactiveLink">You Have To Upload <?=$x?> More Payment</button>         

    <?php }?>
       
    </div>
    </div>
    </div>
    
</div>

    <?php
if (isset($_POST['pay'])) {

    date_default_timezone_set("Singapore");
    $pay_date = date("Y-m-d h:i:sa"); //Order DAte
    
    $queryPaid = "UPDATE userorder SET 
    paid='yes',
    paymentDate='$pay_date'
    WHERE userID='$userID' AND deleted='no' AND paid='no'";
    
    if (mysqli_query($conn, $queryPaid)) {
 
        $_SESSION['loginUser'] = "<div style='color: green' class='alert alert-success text-center'>Cart Payment Validation Sent!, check your History</div>";
        echo '
			<script>
			sweetAlert({
					title: "Order Semt For Validation!",
					text: "Check Your History",
					type: "success",
				},

				function(){
							window.location.href ="userHomepage.php";
				});

				</script>
				';

    } else {
        $_SESSION['payError'] = "<div style='color: red' class='alert alert-danger text-center'>Sorry Payment Validation Failed</div>";
        echo '
        <script>
        sweetAlert({
                title: "Yikes! Payment Failure",
                text: "Get in contact with Admin",
                type: "warning",
            },

            function(){
                        window.location.href ="payment.php";
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