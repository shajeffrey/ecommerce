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
        $vRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$vendorID' "));
        $vName = $vRow['vendorName'];

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
    $_SESSION['loginUser'] = "<div style='color: red' class='alert alert-danger text-center'>Sorry! Product Not Found</div>";
    echo '<script>window.location.href = "userHomepage.php"</script>';
}
?>

<div class="container mt-5">

                <form action="" id="qty" method="POST" enctype="multipart/form-data">
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
                                    <h3 style="color:#007dd6 ;">Add Order : <?=$vName?></h3>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6" >
                                        <div class="form-group">
                                            <label for="prodName">Item Name</label>
                                            <input readonly type="text" class="form-control inactiveLink input-update" name="prodName" id="prodName" value="<?=$prodName?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="prodCat">Category</label>
                                            <select readonly name="prodCat" class="form-control inactiveLink input-update">
                                            <option  value="<?php echo $categoryID;?>"> <?php echo "$cat"; ?></option>
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="prodDesc">Description</label>
                                            <textarea readonly class="form-control inactiveLink input-update" required rows="4" name="prodDesc" id="prodDesc"><?=$prodDesc?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodPrice">Price (RM)</label>
                                            <input readonly type="number" step=".01" min="0" class="form-control inactiveLink input-update" required name="prodPrice" id="prodPrice" value="<?=$prodPrice?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodDisc">Discount (%)</label>
                                            <input readonly type="number" min="0" max="100" class="form-control inactiveLink input-update" required name="prodDisc" id="prodDisc" value="<?=$discAmount?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodInv">Quantity Remaining</label>
                                            <input readonly type="number" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control inactiveLink input-update" required name="prodInv" id="prodInv" value="<?=$inventoryNo?>">
                                        </div>
                                    </div>

                                   <div class="col-12 col-sm-12 text-center" style="padding: 0% 30% ;">
                                        <div class="form-group">
                                            <label for="prodQuantity">Enter Your Quantity</label>
                                            <input type="number" min="1" step="1"  oninput="" title="Numbers only" onkeypress="return event.charCode >= 48 && event.charCode <= 57" max="<?=$inventoryNo?>" class="form-control text-center input-update" required name="prodQuantity" id="prodQuantity" value="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4 text-center">
                                        <div class="form-group">
                                            <label for="singleUnit">Unit After Discount</label>
                                            <input type="text" readonly style="background-color:white;" class="form-control text-center input-update-2" required name="singleUnit" id="singleUnit" value="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-5 text-center" style="padding: 0% 5% ;">
                                        <div class="form-group">
                                            <label for="prodTotal">Sum of Units</label>
                                            <input type="text"  min="1" step=".01" style="background-color:white;" readonly class="form-control text-center  input-update-2" required name="prodTotal" id="prodTotal" value="">
                                        </div>
                                    </div>

                                    <input readonly type="hidden" name="productID" value="<?=$productID;?>">
                                    <input readonly type="hidden" name="vendorID" value="<?=$vendorID;?>">
                                    <input readonly type="hidden" id="hiddenUnit" name="hiddenUnit" value="">
                                    <input readonly type="hidden" id="hiddenTotal" name="hiddenTotal" value="">

                                    <div class="col-12 text-right col-sm-3 " style="padding: 0% 5% 0% 0%; margin:4% 0% 0% 0%;">
                                        <button type="submit" name="addCart"  class="btn" style="background-color:#007dd6; color:white;">Add to cart</button>
                                    </div>

                                    <!-- ERROR CHECKING PLACE  -->
                                    <?php if (isset($_SESSION['userProduct'])): ?>

                                    <div class="col-12 col-sm-8">
                                        <div class="alert alert-danger text-center" role="alert">
                                        <?php 
                                        echo $_SESSION['userProduct'];
                                        unset($_SESSION['userProduct']);
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

<script>

    var formInputs = document.forms.qty;
    var fields = formInputs.elements;

    var prodPrice = fields.prodPrice;
    var prodDisc = fields.prodDisc;
    var prodQty = fields.prodQuantity;
    var unit1 = fields.singleUnit;
    var totalQty = fields.prodTotal;
    var hiddenUnit = fields.hiddenUnit;
    var hiddenTotal = fields.hiddenTotal;

    formInputs.oninput = validate;

    function validate(e) {

        if(prodQty.value != ''){
         
            var afterDisc = prodPrice.value - (prodPrice.value * (prodDisc.value/100));
            var totalAfter = afterDisc * prodQty.value;
            
            unit1.value = "RM" + afterDisc;
            totalQty.value = "RM" + afterDisc + " X " + prodQty.value + " Units = RM" + totalAfter;
            hiddenUnit.value = afterDisc;
            hiddenTotal.value = totalAfter;

        }else{
            unit1.value = '';
            totalQty.value = '';
            hiddenUnit.value = '';
            hiddenTotal.value = '';
        }
    }

</script>

<?php
if (isset($_POST['addCart'])) {

    $userID = $_SESSION['userID'];
    $prodID = $_POST['productID'];
    $vendorID = $_POST['vendorID'];
    $prodInv = $_POST['prodInv'];
    $prodDisc = $_POST['prodDisc'];

    $prodQuantity = $_POST['prodQuantity'];
    $hiddenUnit = $_POST['hiddenUnit'];
    $hiddenTotal = $_POST['hiddenTotal'];
    
    $stockLeft = $prodInv - $prodQuantity;
    
    if( $stockLeft == 0)
    {
        $instock = "no"; //set instock to NO if no inventory available ( 0 )
    }else{
        $instock = "yes";
    }
    
    $updateProd= "UPDATE `product` SET 
    `inventoryNo`='$stockLeft',
    `inStock`='$instock' WHERE productID='$prodID'";
    
    if (!mysqli_query($conn, $updateProd)) {

        $_SESSION['updateProd'] = "<div style='color: red' class='alert alert-danger text-center'>Update Product Inv unsuccesful.</div>";
        echo '<script>window.location.href = "userHomepage.php"</script>';
        
        mysqli_error($conn);
        
    } 

    $insertOrder = "INSERT INTO `userorder`(`userID`, `receiveDate`, `fulfilled`, `deleted`, `paid`, `paymentDate`) VALUES 
    ('$userID','','no','no','no','')";

    if (mysqli_query($conn, $insertOrder)) {
        $orderRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `userorder` ORDER BY orderID DESC LIMIT 1"));
        $orderID = $orderRow['orderID'];  

    } else {
        $_SESSION['insertOrder'] = "<div style='color: red' class='alert alert-danger text-center'>Insert Order unsuccesful</div>";
        echo '<script>window.location.href = "userHomepage.php"</script>';
      
        mysqli_error($conn);
    }
    
    $insertCart = "INSERT INTO cart VALUES ('','$orderID','$prodID','$hiddenUnit','$prodQuantity','$prodDisc', '$hiddenTotal', 'no')";
    
    if (mysqli_query($conn, $insertCart)) {
 
        $_SESSION['addCart'] = "<div style='color: green' class='alert alert-success text-center'>Add to Cart Success</div>";
        echo '<script>window.location.href = "userHomepage.php"</script>';

    } else {
        $_SESSION['addCart'] = "<div style='color: red' class='alert alert-danger text-center'>Add to Cart unsuccesful</div>";
        echo '<script>window.location.href = "userHomepage.php"</script>';
      
        mysqli_error($conn);
    }

    mysqli_close($conn);
    
}
?>



<?php
include 'templates/footer.php';
?>