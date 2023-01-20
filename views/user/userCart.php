<!-- USER CART -->
<?php
include 'templates/uHomeHeader.php';

$userID = $_SESSION['userID'];

$query = "SELECT * 
FROM cart 
JOIN userorder 
ON cart.orderID = userorder.orderID
WHERE userorder.userID='$userID' AND userorder.deleted='no' AND userorder.paid='no' ORDER BY `cartID` DESC";
?>

<div class="container-fluid ">
    
    <div style="background-color: #fff; border-radius:10px;" class="m-5 p-4">

    <?php if (isset($_SESSION['updateCart'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['updateCart'];
            unset($_SESSION['updateCart']);
            ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['deleteOrder'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['deleteOrder'];
            unset($_SESSION['deleteOrder']);
            ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['updateProdInv'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['updateProdInv'];
            unset($_SESSION['updateProdInv']);
            ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['updateProd'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['updateProd'];
            unset($_SESSION['updateProd']);
            ?>
    </div>
    <?php endif; ?>

    <h2 style="color:#007dd6;">Manage Cart</h2>

    <?php 
     $cartList = mysqli_query($conn, $query);
     //Count Rows to check whether we have foods or not
     $count = mysqli_num_rows($cartList);

     if($count == 0){
    ?>
    <a  href="payment.php" style="background-color:#007dd6; color:white;" class="btn inline float-right inactiveLink2 mb-3 faded">Make Payments?</a> 
    
    <?php } else{ ?>
        
        <a  href="payment.php" style="background-color:#007dd6; color:white;" class="btn inline float-right mb-3 ">Make Payments?</a> 

    <?php }?>

    <br>       
    <table style="background-color: rgba(255,255,255,0.1); box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);"  class="table text-center table-bordered">
        <thead style="color:#007dd6;">
        <tr class="tr">
            <th style="width: 3%;">No.</th>
            <th>Vendor</th>
            <th style="width: 17%;">Image</th>
            <th>Item Name</th>
            <th>Category</th>
            <th style="width: 10%;">Discounted Price/Unit</th>
            <th style="width: 7%;">Quantity</th>
            <th style="width: 7%;">Discount</th>
            <th style="width: 8%;">Total</th>
            <th style="width: 13%;">Actions</th>
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
                $approved = $cartRow['approved'];
                $proof = $cartRow['proof'];
                $productID = $cartRow['productID'];
                    $prodRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `product` WHERE productID='$productID' "));
                    
                    $vendorID = $prodRow['vendorID'];
                    $venRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$vendorID' "));
                    $vendorName = $venRow['vendorName'];
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
        ?>

        <tr>
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
            <td><?php echo $category; ?></td>
            <td>RM<?php echo $discPrice; ?></td>
            <td><?php echo $qty; ?></td>
            
            <td><?php echo $disc; ?>%</td>
            <td>RM<?php echo $total; ?></td>

            <td>
                <?php if($approved=='no' ) {?>

                <a  class="btn btn-link inactiveLink" style="color: red;">Payment Rejected</a>
                <?php }else if($proof!='') { ?>

                <a  class="btn btn-link inactiveLink" style="color: red;">Payment already uploaded</a>
                <?php } else { ?>
                <a href="userUpdate.php?prodID=<?php echo $productID;?>&cartID=<?php echo $cartID; ?>" class="btn btn-link" >Update Order</a>
                <?php } ?>
            
                <a onclick="return confirm('Are you sure you want to delete this item?');" href="userDelete.php?deleteID=<?php echo $cartID;?>" class="btn btn-link" >Delete Item</a>

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
    </div>

<?php

include 'templates/footer.php';
?>