
<?php
include 'templates/uHomeHeader.php';
?>

<!-- margin y axis (top/bottom) -->
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h2>Find Results</h2>
    </div>
</div>


<?php

//mix of decision by user to search
if(!empty($_POST['catSearch']) && !empty($_POST['typeSearch'])){
    
    $catID = $_POST['catSearch'];
    $prodName = $_POST['typeSearch'];
    $query = "SELECT * FROM `product` WHERE inStock='yes' AND categoryID='$catID' AND prodName LIKE '%$prodName%'  ";
} 
if(!empty($_POST['catSearch']) && empty($_POST['typeSearch'])){
    
    $catID = $_POST['catSearch'];
    $query = "SELECT * FROM `product` WHERE inStock='yes' AND categoryID='$catID'";
} 
if(empty($_POST['catSearch']) && !empty($_POST['typeSearch'])){
    
    $prodName = $_POST['typeSearch'];
    $query = "SELECT * FROM `product` WHERE inStock='yes' AND prodName LIKE '%$prodName%'  ";
} 
if(empty($_POST['catSearch']) && empty($_POST['typeSearch'])){
    
    $_SESSION['searchBox'] = "<div style='color: red' class='alert alert-danger text-center'>Enter a Product to Search.</div>";
    echo '<script>window.location.href = "userHomepage.php"</script>';
    die();
} 

?>


<div style="background-color: white; padding: 0px 20px;">
<div class="container justify-content-center mt-50 mb-50 ">

        <div class="row pt-3 pb-3">
        <!-- PRODUCT CATALOGUE GRID -->
        <?php
        $userID = $_SESSION['userID'];
        //$query = "SELECT * FROM `product` WHERE inStock='yes' ";

        $prodCatalogue = mysqli_query($conn, $query);

        if (mysqli_num_rows($prodCatalogue) > 0) 
        {
            while($row = mysqli_fetch_assoc($prodCatalogue))
            {
                $productID = $row['productID'];
                $vendorID = $row['vendorID'];
                  //get corresponding category name
                  $categoryID = $row['categoryID'];
                  $catRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `category` WHERE categoryID='$categoryID' "));
                  $category = $catRow['categoryName'];

                $prodName = $row['prodName'];
                $prodDesc = $row['prodDesc'];
                $inventoryNo = $row['inventoryNo'];
                $prodPrice = $row['prodPrice'];
                //$inStock = $row['inStock'];
                $discAmount = $row['discAmount'];
                $prodPicture = $row['prodPicture'];
                 ?>

                <div class="col-md-4 mt-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-img-actions">
                                <?php 
                                //Check whether image available or not
                                if($prodPicture=="")
                                {
                                    //Image not Available
                                    ?>
                                    <img src="../../assets/images/product/error2.jpg" alt="Product Pic" class="card-img img-fluid">
                                    <?php
                                    //echo "<div class='error'>Image not available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="../../assets/images/product/<?php echo $prodPicture; ?>" alt="Product Pic" class="card-img img-fluid" >
                                    <?php
                                }
                                ?>
                                        <!-- <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1562074043/234.png" class="card-img img-fluid" width="96" height="350" alt=""> -->
                                </div>
                            </div>
                            <div class="card-body bg-light text-justify">
                            <div class="mb-2">
                                    <h6 class="font-weight-semibold mb-2">
                                        <a href="#" class="text-default mb-2 inactiveLink" data-abc="true"><?=$prodName; ?></a>
                                    </h6>
                                    <a href="#" class="text-muted inactiveLink" data-abc="true"><?=$category; ?></a>
                                    <hr>
                                  
                                </div>
                                <h3 class="mb-0 font-weight-semibold">RM<?=$prodPrice;?></h3>
                                
                                <?php   
                                $x = 'no';
                                
                                //  $catRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `userorder` WHERE userID='$userID' "));
                                //  $cat = $catRow['categoryName'];

                                $query = "SELECT * FROM `userorder` WHERE userID='$userID' AND deleted='no' AND paid='no' ";

                                $orderTable = mysqli_query($conn, $query);

                                if (mysqli_num_rows($orderTable) > 0) 
                                {
                                    while($row = mysqli_fetch_assoc($orderTable))
                                    {
                                        $orderID = $row['orderID'];
                                        $query2 = "SELECT * FROM `cart` WHERE orderID='$orderID' AND productID='$productID' AND completed='no'   ";
                                        $cartTable = mysqli_query($conn, $query2);

                                        if (mysqli_num_rows($cartTable) == 1 ){
                                            $x = 'yes';
                                            $row = mysqli_fetch_assoc($cartTable);
                                            $cartID = $row['cartID'];

                                            ?>
                                            <div class="text-muted mb-3">Availability to Add to Order: <?=$inventoryNo; ?></div>
                                            <a href="userUpdate.php?prodID=<?php echo $productID;?>&cartID=<?php echo $cartID; ?>" type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i>Update Your Order?</a>
                                            
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <?php
                                if ($x == 'no'){
                                ?>
                                    <div class="text-muted mb-3">Available : <?=$inventoryNo; ?></div>
                                    <a href="userProduct.php?prodID=<?php echo $productID; ?>" type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i>Add to cart</a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                </div>
           <?php
                }
            }
            else
            {
                //Products Not Available 
                echo "<div class='alert col-12 alert-danger text-center'>No Products Available.</div>";
            }
            ?>

        </div>
    </div>
    </div>

<?php
include 'templates/footer.php';
?>
