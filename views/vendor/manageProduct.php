<?php
include 'templates/vHomeHeader.php';
?>

<div class="container-fluid ">
    
    <div style="background-color: #fff; border-radius:10px;" class="m-5 p-4">

    <?php if (isset($_SESSION['addProd'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['addProd'];
            unset($_SESSION['addProd']);
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

    <?php if (isset($_SESSION['deleteProd'])): ?>
    <div class="col-12">
            <?php 
            echo $_SESSION['deleteProd'];
            unset($_SESSION['deleteProd']);
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

    <h2 style="color:#6A0DAD;">Manage Vendor Products</h2>
    <a  href="addProduct.php" style="background-color:#6A0DAD; color:white;" class="btn inline float-right mb-3 ">Add Product</a> 
    <br>       
    <table style="background-color: rgba(255,255,255,0.1); box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);"  class="table text-center table-bordered">
        <thead style="color:#6A0DAD;">
        <tr>
            <th>No.</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Inventory</th>
            <th>Available</th>
            <th style="width: 15%;">Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php 
        $vendorID = $_SESSION['vendorID'];
        $query = "SELECT * FROM product WHERE vendorID='$vendorID' ORDER BY `productID` DESC";
        //Execute the qUery
        $getProduct = mysqli_query($conn, $query);
        //Count Rows to check whether we have foods or not
        $count = mysqli_num_rows($getProduct);
        //Create Serial Number VAriable and Set Default VAlue as 1
        $sn=1;

        if($count>0)
        {
            //We have food in Database
            //Get the Foods from Database and Display
            while($row=mysqli_fetch_assoc($getProduct))
            {
                //get the values from individual columns
                $productID = $row['productID'];

                    $categoryID = $row['categoryID'];
                    $catRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `category` WHERE categoryID='$categoryID' "));
                    $category = $catRow['categoryName'];

                $prodName = $row['prodName'];
                $prodPrice = $row['prodPrice'];
                $prodPicture = $row['prodPicture'];
                $inventoryNo = $row['inventoryNo'];
                $inStock = $row['inStock'];
                $discAmount = $row['discAmount'];     
        ?>

        <tr>
           <td ><?php echo $sn++; ?>. </td>
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
                        <img src="../../assets/images/product/<?php echo $prodPicture; ?>" width="150px" height="150px">
                        <?php
                    }
                ?>
            </td>
            <td><?php echo $prodName; ?></td>
            <td><?php echo $category; ?></td>
            <td>RM<?php echo $prodPrice; ?></td>
            <td><?php echo $discAmount; ?></td>
            
            <td><?php echo $inventoryNo; ?></td>
            <td><?php echo $inStock; ?></td>
            <td>
                <a href="updateProduct.php?prodID=<?php echo $productID;?>" class="btn">Update Item</a>
            
                <a onclick="return confirm('Are you sure you want to delete this product?');" href="deleteProduct.php?deleteID=<?php echo $productID;?>&currentImage=<?php echo $prodPicture; ?>" class="btn">Delete Item</a>
            </td>
        </tr>
        
        <?php
                }
            }
            else
            {
                //Food not Added in Database
                echo "<tr> <td colspan='12' class='text-center'> No Menu Added . </td> </tr>";
            }

        ?>

        </tbody>
    </table>
    </div>
</div>
<div style="margin-top: 60px ;"></div>
<?php

include 'templates/footer.php';
?>