<?php
session_start();
include 'templates/vHomeHeader.php';
include '../../controllers/search.php';
?>
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Welcome <?=$_SESSION['vendorName'];?></h1>
    </div>
</div>
<?php
if (isset($_SESSION['loginVendor'])) {
    echo $_SESSION['loginVendor'];
    unset($_SESSION['loginVendor']);
}
?>
<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card p-3  py-4">
                    <h5>Search Your Catalogue</h5>
                    <div class="row g-3 mt-2">

                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Search Your Catalogue?">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-secondary btn-block" name="searchbyVendor">Search Results</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div style="background-color: white; padding: 0px 20px;">
<div class="container justify-content-center mt-50 mb-50 ">

        <div class="row pt-3 pb-3">
        <!-- VENDOR PRODUCT CATALOGUE -->
        <?php
        $id = $_SESSION['vendorID'];
        $query = "SELECT * FROM `product` WHERE vendorID='$id' ";

        $vendorCatalogue = mysqli_query($conn, $query);

        if (mysqli_num_rows($vendorCatalogue) > 0) 
        {
            while($row = mysqli_fetch_assoc($vendorCatalogue))
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
                                    <a href="#" class="text-muted" data-abc="true">Item Category</a>
                                </div>
                                <h3 class="mb-0 font-weight-semibold">RM<?=$prodPrice;?></h3>
                            
                                <div class="text-muted mb-3">34 Bought</div>
                                <a href="vendorProduct?prodID=<?php echo $productID; ?>" type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Add to cart</a>
                            </div>
                        </div>
                </div>
           <?php
                }
            }
            else
            {
                //Products Not Available 
                echo "<div class='alert alert-danger text-center'>Products not available.</div>";
            }
            ?>

        </div>
    </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php
include 'templates/footer.php';
?>
<?php
if (isset($_REQUEST['searchVendor'])) {
    $search = new search();
    $search->search_vendor($_REQUEST);
}
?>
