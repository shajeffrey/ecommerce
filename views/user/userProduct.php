<?php
include 'templates/uHomeHeader.php';
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
        $catRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `category` WHERE categoryID='$categoryID' "));
        $cat = $catRow['categoryName'];

    $prodName = $row['prodName'];
    $prodDesc = $row['prodDesc'];
    $inventoryNo = $row['inventoryNo'];
    $prodPrice = $row['prodPrice'];
    $inStock = $row['inStock'];
    $discAmount = $row['discAmount'];
    $currentPicture = $row['prodPicture'];
} else {
    //If not found redirect to vendorhomepage
    $_SESSION['loginVendor'] = "<div style='color: red' class='alert alert-danger text-center'>Sorry! Product Not Found</div>";
    echo '<script>window.location.href = "vendorHomepage.php"</script>';
}
?>

<div class="container mt-5">

                <form action="" id="wizard" method="POST" enctype="multipart/form-data">
                    <!-- SECTION 1 -->
                    <h2 style="text-align: center ;"></h2>
                    <section>
                        <div class=" inner-update">
                            <div class="image-holder-update" >
                    <?php 
                        //Check whether image available or not
                        if($currentPicture=="")
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
                            <img src="../../assets/images/product/<?php echo $currentPicture; ?>"  class="card-img-update img-fluid" >
                            <?php
                        }
                    ?>
                            </div>
                            <div class="p-4">
                                <div class="col-12 form-header-update text-center">
                                    <h3 style="color:#6A0DAD ;">Add to Cart</h3>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6" >
                                        <div class="form-group">
                                            <label for="prodName">Item Name</label>
                                            <input type="text" class="form-control input-update" required name="prodName" id="prodName" value="<?=$prodName?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="prodCat">Item Category</label>
                                            <select name="prodCat" class="form-control input-update">

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
                                    <option <?php if($cat==$categoryName) {echo "selected";} ?> value="<?php echo $categoryID;?>"> <?php echo "$categoryName"; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="0">Error! Not Found</option>
                                <?php
                            }
                        ?>
                                             </select>
                                          
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="prodDesc">Item Description</label>
                                            <textarea class="form-control input-update" required rows="4" name="prodDesc" id="prodDesc"><?=$prodDesc?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodPrice">Item Price (RM)</label>
                                            <input type="number" step=".01" min="0" class="form-control input-update" required name="prodPrice" id="prodPrice" value="<?=$prodPrice?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodDisc">Item Discount(%)</label>
                                            <input type="number" min="0" max="100" class="form-control input-update" required name="prodDisc" id="prodDisc" value="<?=$discAmount?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodInv">Item Inventory</label>
                                            <input type="number" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control input-update" required name="prodInv" id="prodInv" value="<?=$inventoryNo?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="prodPic">Item Image</label>
                                            <input type="file" class="form-control-file input-update"  name="prodPic" id="prodPic" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="Availability">Item Available?</label> <br>

                                            <div class="form-check form-check-inline">
                                            <input <?php if($inStock=="yes") {echo "checked";} ?> type="radio" name="instock" value="yes">
                                            <label class="form-check-label" for="inlineCheckbox2">Yes</label>
                                            </div>
                                            <span style="margin-left: 25px;"></span>
                                            <div class="form-check form-check-inline">
                                            <input <?php if($inStock=="no") {echo "checked";} ?> type="radio" name="instock" value="no">
                                            <label class="form-check-label" for="inlineCheckbox2">No</label>       
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="productID" value="<?=$productID;?>">
                                   <input type="hidden" name="currentPicture" value="<?=$currentPicture;?>">
                                   <input type="hidden" name="vendorID" value="<?=$vendorID;?>">
    
                                    <div class="col-12 col-sm-4">
                                        <button type="submit" name="update" class="btn" style="background-color:#6A0DAD; color:white;">Update Item</button>
                                    </div>

                                    <!-- ERROR CHECKING PLACE  -->
                                    <?php if (isset($_SESSION['updateProduct'])): ?>

                                    <div class="col-12 col-sm-8">
                                        <div class="alert alert-danger text-center" role="alert">
                                        <?php 
                                        echo $_SESSION['updateProduct'];
                                        unset($_SESSION['updateProduct']);
                                        ?>
                                        </div>
                                    </div>

                                    <?php endif; ?>
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