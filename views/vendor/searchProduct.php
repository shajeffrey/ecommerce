<?php
include 'templates/vHomeHeader.php';
?>

<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h2>Find Results</h2>
    </div>
</div>

<?php 
//Get Search Keyword
$search = $_POST['searchProd'];
?>

<div class="container">
    <form action="searchProduct.php" method="POST">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card p-3  py-4">
                    <h5>Search Your Catalogue</h5>
                    <div class="row g-3 mt-2">
                        
                        <div class="col-md-9">
                            <input type="text" name="searchProd" class="form-control" placeholder="Search Your Catalogue?">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-secondary btn-block" name="searchbyVendor">Search Results</button>
                        </div>

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
        <!-- VENDOR PRODUCT CATALOGUE -->
        <?php
        $id = $_SESSION['vendorID'];
        $query = "SELECT * FROM `product` WHERE vendorID='$id' AND prodName LIKE '%$search%' ";

        $vendorCatalogue = mysqli_query($conn, $query);

        if (mysqli_num_rows($vendorCatalogue) > 0) 
        {
            while($row = mysqli_fetch_assoc($vendorCatalogue))
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
                                    <a href="#" class="text-muted inactiveLink" data-abc="true"><?=$prodDesc; ?></a>
                                </div>
                                <h3 class="mb-0 font-weight-semibold">RM<?=$prodPrice;?></h3>
                            
                                <div class="text-muted mb-3">Available : <?=$inventoryNo; ?></div>
                                <a href="updateProduct.php?prodID=<?php echo $productID; ?>" type="button" class="btn bg-cart"><i class="fa fa-cart-plus "></i>Update Product?</a>
                            </div>
                        </div>
                </div>
           <?php
                }
            }
            else
            {
                //Products Not Available 
                echo "<div class='alert col-12 alert-danger text-center'>Products not available.</div>";
            }
            ?>

        </div>
    </div>
    </div>

<?php
include 'templates/footer.php';
?>
