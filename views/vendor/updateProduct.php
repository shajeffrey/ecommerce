<?php
session_start();
include 'templates/vHomeHeader.php';
include '../../controllers/search.php';
?>

<?php
if(isset($_GET['prodID'])){

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
    //$inStock = $row['inStock'];
    $discAmount = $row['discAmount'];
    $prodPicture = $row['prodPicture'];
}else{
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
                        <div class="inner">
                            <div class="image-holder">
                            <img src="../../assets/images/product/<?php echo $prodPicture; ?>" alt="Product Pic" class="card-img img-fluid" >
                            </div>
                            <div class="form-content" >
                                <div class="form-header">
                                    <h3>Registration</h3>
                                </div>
                                <p>Please fill with your details</p>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label for="name"> NAME</label>
                                        <input type="text" placeholder="First Name" class="form-control">
                                    </div>
                                    <div class="form-holder">
                                        <input type="text" placeholder="Last Name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <input type="text" placeholder="Your Email" class="form-control">
                                    </div>
                                    <div class="form-holder">
                                        <input type="text" placeholder="Phone Number" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <input type="text" placeholder="Age" class="form-control">
                                    </div>
                                    <div class="form-holder" style="align-self: flex-end; transform: translateY(4px);">
                                        <div class="checkbox-tick">
                                            <label class="male">
                                                <input type="radio" name="gender" value="male" checked> Male<br>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="female">
                                                <input type="radio" name="gender" value="female"> Female<br>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkbox-circle">
                                    <label>
                                        <input type="checkbox" checked> Nor again is there anyone who loves or pursues or desires to obtaini.
                                        <span class="checkmark"></span>
                                    </label>
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
if (isset($_REQUEST['searchVendor'])) {
    $search = new search();
    $search->search_vendor($_REQUEST);
}
?>