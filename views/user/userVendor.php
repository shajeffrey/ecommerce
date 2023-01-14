<?php
include 'templates/uHomeHeader.php';


if (isset($_GET['vendorID'])) {

$getid = $_GET['vendorID'];

} else {
//If not found redirect to vendorhomepage
$_SESSION['loginUser'] = "<div style='color: red' class='alert alert-danger text-center'>Sorry! Vendor Products Not Found</div>";
echo '<script>window.location.href = "userHomepage.php"</script>';
}
?>

<!-- margin y axis (top/bottom) -->
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Welcome <?=$_SESSION['userFullname'];?></h1>
    </div>
</div>

<div class="container">
    <form action="userSearch.php" method="POST">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card p-3  py-4">
                    <h5>Find Your Product</h5>
                    <?php
                    if (isset($_SESSION['searchBox'])) {
                        echo $_SESSION['searchBox'];
                        unset($_SESSION['searchBox']);
                    }
                    ?>
                    <div class="row g-3 mt-2">
                        <div class="col-md-3">
                            <div class="dropdown">
                           
                            <!--php category here -->
                            <select class="btn btn-secondary dropdown-toggle" style="padding: 4% 4% ;" name="catSearch" >
                            <option value="" disabled selected hidden>Choose Category</option>
                            <option value="" >No Category</option>
                            <?php 
                            $sql = "SELECT * FROM `category`";
                            $categories = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($categories);
                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($categories))
                                {
                                    //get the details of categories
                                    $categoryID = $row['categoryID'];
                                    $categoryName = $row['categoryName'];
                                    $categoryDesc = $row['categoryDesc'];
                                    ?>
                                    <option  value="<?php echo $categoryID;?>"> <?php echo "$categoryName"; ?></option>             
                                     <?php
                                }
                            }
                            else
                            {
                                ?>
                                 <option class="dropdown-item alert-danger inactiveLink" >Sorry! Error</option>
                                <?php
                            }
                        ?>
                            </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="typeSearch" placeholder="What Products Do You Want to See?">
                        </div>

                        <div class="col-md-3">
                            <button class="btn btn-secondary btn-block" type="submit">Search Results</button>
                        </div>

                    </div>

                  </div>
            </div>
        </div>
    </form>
</div>

<div style="background-color: white; padding: 0px 20px;">
<div class="container justify-content-center mt-50 mb-50 ">

        <div class="row pt-3 pb-3">
        <!-- PRODUCT CATALOGUE GRID -->
        <?php
        $userID = $_SESSION['userID'];
        $query = "SELECT * FROM `product` WHERE inStock='yes' AND vendorID='$getid' ";

        $prodCatalogue = mysqli_query($conn, $query);

        if (mysqli_num_rows($prodCatalogue) > 0) 
        {
            while($row = mysqli_fetch_assoc($prodCatalogue))
            {
                $productID = $row['productID'];

                  $vendorID = $row['vendorID'];
                  $vRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$vendorID' "));
                  $vName = $vRow['vendorName'];

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
                                        <a href="#" class="text-default mb-2 inactiveLink" data-abc="true"><?=$prodName; ?></a><br>
                                        
                                    </h6>
                                    <u><a href="#" class="text-muted  mt-1" data-abc="true">Vendor   :<?=$vName; ?></a></u><br>
                                    <a href="#" class="text-muted inactiveLink" data-abc="true">Category :<?=$category; ?></a><br>
                                    <hr>
                                
                                </div>
                                <h3 class="mb-0 font-weight-semibold">RM<?=$prodPrice;?></h3>
                                
                                <?php   
                                $x = 'no';
                                
                                //  $catRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `userorder` WHERE userID='$userID' "));
                                //  $cat = $catRow['categoryName'];
                                //LIKE JOIN BUT FRIGGIN HARD TO UNDERSTAND
                                $query = "SELECT * FROM `userorder` WHERE userID='$userID' AND deleted='no' AND paid='no' ";

                                $orderTable = mysqli_query($conn, $query);

                                if (mysqli_num_rows($orderTable) > 0) 
                                {
                                    while($row = mysqli_fetch_assoc($orderTable))
                                    {
                                        $orderID = $row['orderID'];
                                        $query2 = "SELECT * FROM cart 
                                        JOIN userorder ON cart.orderID = userorder.orderID
                                        WHERE cart.orderID='$orderID' AND cart.productID='$productID' AND completed='no' AND approved='' AND proof='' ";
                                        $cartTable = mysqli_query($conn, $query2);

                                        if (mysqli_num_rows($cartTable) == 1 ){
                                            $x = 'yes';
                                            $row = mysqli_fetch_assoc($cartTable);
                                            $cartID = $row['cartID'];

                                            ?>
                                            <div class="text-muted mb-3">Availability to Add to Order: <?=$inventoryNo; ?></div>
                                            <a href="userUpdate.php?prodID=<?php echo $productID;?>&cartID=<?php echo $cartID; ?>" type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i>Update Product Order?</a>
                                            
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
                echo "<div class='alert col-12 alert-danger text-center'>No Products not Available.</div>";
            }
            ?>

        </div>
    </div>
    </div>

<?php
include 'templates/footer.php';
?>

