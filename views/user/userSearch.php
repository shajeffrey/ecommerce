
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
        // $query = "SELECT * FROM `product` WHERE inStock='yes' ";

        $prodCatalogue = mysqli_query($conn, $query);

        if (mysqli_num_rows($prodCatalogue) > 0) 
        {
            while($row = mysqli_fetch_assoc($prodCatalogue))
            {
                $productID = $row['productID'];
                $vendorID = $row['vendorID'];
                $categoryID = $row['categoryID'];
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
                            <div class="card-body bg-light text-center">
                                <div class="mb-2">
                                    <h6 class="font-weight-semibold mb-2">
                                        <a href="#" class="text-default mb-2" data-abc="true"><?= $prodName; ?></a>
                                    </h6>
                                    <a href="#" class="text-muted" data-abc="true">Laptops & Notebooks</a>
                                </div>
                                <h3 class="mb-0 font-weight-semibold">RM<?=$prodPrice;?></h3>
                                <!-- <div>
                                    <i class="fa fa-star star"></i>
                                    <i class="fa fa-star star"></i>
                                    <i class="fa fa-star star"></i>
                                    <i class="fa fa-star star"></i>
                                </div> -->
                                <div class="text-muted mb-3">34 reviews</div>
                                <a href="userProduct?prodID=<?php echo $productID; ?>" type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Add to cart</a>
                            </div>
                        </div>
                </div>
           <?php
                }
            }
            else
            {
                //Products Not Available 
                echo "<div class='alert col-12 alert-danger text-center'>Sorry, Your Search Found no Products</div>";
            }
            ?>

        </div>
    </div>
    </div>

<?php
include 'templates/footer.php';
?>
