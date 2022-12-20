<?php
session_start();
include 'templates/vHomeHeader.php';
include '../../controllers/manageProduct.php';
?>

<?php
if (isset($_GET['prodID'])) {

    $getid = $_GET['prodID'];

    $query = "SELECT * FROM `product` WHERE productID='$getid' ";

    $getProductDetails = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($getProductDetails);

    $productID = $row['productID'];
    $vendorID = $row['vendorID'];
    $categoryID = $row['categoryID'];
    $prodName = $row['prodName'];
    $prodDesc = $row['prodDesc'];
    $inventoryNo = $row['inventoryNo'];
    $prodPrice = $row['prodPrice'];
    $inStock = $row['inStock'];
    $discAmount = $row['discAmount'];
    $prodPicture = $row['prodPicture'];
} else {
    //If not found redirect to vendorhomepage
    $_SESSION['loginVendor'] = "<div style='color: red' class='alert alert-danger text-center'>Sorry! Product Not Found</div>";
    echo '<script>window.location.href = "vendorHomepage.php"</script>';
}
?>

<div class="container mt-5">

                <form action="" id="wizard">
                    <!-- SECTION 1 -->
                    <h2 style="text-align: center ;"></h2>
                    <section>
                        <div class="d-flex inner-update">
                            <div class="float-left image-holder-update" style="">
                            <img src="../../assets/images/product/<?php echo $prodPicture; ?>" alt="Product Pic" class="card-img-update img-fluid" >
                            </div>
                            <div class="p-4">
                                <div class="col-12 form-header-update text-center">
                                    <h3 style="color:#6A0DAD ;">Product Update</h3>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6" >
                                        <div class="form-group">
                                            <label for="prodName">Product Name</label>
                                            <input type="text" class="form-control input-update" required name="prodName" id="prodName" value="<?php ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="prodCat">Product Category</label>
                                            <input type="text" class="form-control input-update" required name="prodCat" id="prodCat" value="<?php ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="vLocation">Product Description</label>
                                            <textarea class="form-control input-update" required rows="2" name="vLocation" id="vLocation"><?php ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodInv">Product Price</label>
                                            <input type="text" class="form-control input-update" required name="prodInv" id="prodInv" value="<?php ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodInv">Product Discount</label>
                                            <input type="text" class="form-control input-update" required name="prodInv" id="prodInv" value="<?php ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodInv">Product Inventory</label>
                                            <input type="text" class="form-control input-update" required name="prodInv" id="prodInv" value="<?php ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="Availability">Product Availability</label>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <input type="radio" class=" form-control " required name="instock" id="instock" value="yes">Yes
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <input type="radio" class=" form-control" required name="instock" id="instock" value="no">No
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="prodCat">Product Image</label>
                                            <input type="file" class="form-control input-update" required name="prodCat" id="prodCat" value="<?php ?>">
                                        </div>
                                    </div>
                                    <!-- INSTOCK SECTION  -->
                                    <!-- <div class="col-12 col-sm-6">
                                         <div class="addFoodMargin">
                                            <div class="order-label" style="color: rgb(220,53,69);">Active</div>
                                            <input <?php //if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                                            <input <?php //if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No 
                                        </div>
                                         <div class="form-group">
                                            <label class="">
                                                <input type="radio" name="gender" value="male" checked>Yes<br>
                                            </label>
                                            <label class=""> 
                                                <input type="radio" name="gender" value="female">No<br>
                                            </label>
                                        </div> 
                                    </div> -->
                                    <div class="col-12 col-sm-4">
                                        <button type="submit" name="update" class="btn" style="background-color:#6A0DAD; color:white;">Update Item</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </section>
                </form>
        </div>
</div>


<?php
include 'templates/footer.php';
?>
<?php
if (isset($_REQUEST['update'])) {
    $update = new manageProduct();
    $update->product_update($_REQUEST);
}
?>