<?php

include 'templates/vHomeHeader.php';
?>

<div class="container wrapper2 px-4 mt-5">

                <form action="" id="wizard" method="POST" enctype="multipart/form-data">
                    <!-- SECTION 1 -->
                    <h2 style="text-align: center ;"></h2>
                    <section>
                        <div class=" inner-update">

                            <div class="p-4">
                                <div class="col-12 form-header-update text-center">
                                    <h3 style="color:#6A0DAD ;">Product Addition</h3>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6" >
                                        <div class="form-group">
                                            <label for="prodName">Item Name</label>
                                            <input type="text"  class="form-control input-update" required name="prodName" id="prodName" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="prodCat">Item Category</label>
                                            <select name="prodCat" class=" form-control input-update">

                        <?php 
                            $sql = "SELECT * FROM `category` WHERE catDel='no' ";
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
                                    <option  value="<?php echo $categoryID;?>">
                                    <?php echo "$categoryName : $categoryDesc"; ?>
                                    </option>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="0">Sorry! No Categories Available</option>
                                <?php
                            }
                        ?>
                                             </select>
                                          
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label for="prodDesc">Item Description</label>
                                            <textarea class="form-control input-update" required rows="4" name="prodDesc" id="prodDesc"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodPrice">Item Price (RM)</label>
                                            <input type="number" step=".01" min="0" class="form-control input-update" required name="prodPrice" id="prodPrice" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodDisc">Item Discount(%)</label>
                                            <input type="number" min="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" max="100" class="form-control input-update" required name="prodDisc" id="prodDisc" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label for="prodInv">Item Inventory</label>
                                            <input type="number" min="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" max="<?=$inventoryNo?>" class="form-control input-update" required name="prodInv" id="prodInv" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="prodPic">Item Image</label>
                                            <input type="file" class="form-control-file input-update" required name="prodPic" id="prodPic" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="Availability">Item Available?</label> <br>

                                            <div class="form-check form-check-inline">
                                            <input type="radio" name="instock" value="yes" checked>
                                            <label class="form-check-label" for="inlineCheckbox2">Yes</label>
                                            </div>
                                            <span style="margin-left: 25px;"></span>
                                            <div class="form-check form-check-inline">
                                            <input  type="radio" name="instock" value="no">
                                            <label class="form-check-label" for="inlineCheckbox2">No</label>       
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-12 col-sm-4">
                                        <button type="submit" name="add" class="btn" style="background-color:#6A0DAD; color:white;">Add Item</button>
                                    </div>

                                    <!-- ERROR CHECKING PLACE  -->
                                    <?php if (isset($_SESSION['addProduct'])): ?>

                                    <div class="col-12 col-sm-8">
                                        <div class="alert alert-danger text-center" role="alert">
                                        <?php 
                                        echo $_SESSION['addProduct'];
                                        unset($_SESSION['addProduct']);
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
if (isset($_POST['add'])) {

    
        $vendorID = $_SESSION['vendorID'];
        $prodCat = $_POST['prodCat'];
        $prodName = $_POST['prodName'];
        $prodDesc = $_POST['prodDesc'];
        $prodPrice = $_POST['prodPrice'];
        $prodPrice = number_format($prodPrice, 2);
        $prodDisc = $_POST['prodDisc'];
        $prodInv = $_POST['prodInv'];

        if( $prodInv == 0)
        {
            $instock = "no"; //set instock to NO if no inventory available
            $_SESSION['updateProdInv'] = "<div style='color: green' class='alert alert-success text-center'>Item Inventory 0, Product Availability set to no</div>";
        }
        else if( isset($_POST['instock']))
        {
            $instock = $_POST['instock'];
        } else{
            $instock = "no";
        }

    
        if(isset($_FILES['prodPic']['name']))
        {
            //Upload BUtton Clicked
            $image_name = $_FILES['prodPic']['name']; //New Image NAme

            //CHeck whether th file is available or not
            if($image_name!="")
            {
                //IMage is Available
                //A. Uploading New Image
                //REname the Image
                $tmp = explode('.', $image_name); //Gets the extension of the image
                $fileExt = end($tmp); //Gets the extension of the image

                $image_name = "Product-".rand(000000, 999999).'.'.$fileExt; //THis will be renamed image

                //Get the Source Path and DEstination PAth
                $src = $_FILES['prodPic']['tmp_name']; //Source Path
                $dst = "../../assets/images/product/".$image_name; //DEstination Path
                //Upload the imager
                $upload = move_uploaded_file($src,$dst);
                /// CHeck whether the image is uploaded or not
                if($upload==false)
                {
                    //FAiled to Upload
                    $_SESSION['addProduct'] = "<div>Failed to Upload Image</div>";
                    //REdirect to Manage Food 
                    echo '<script>window.location.href = window.location.href</script>';
                    //Stop the Process
                    die();
                }
              
            }
       
        }
        else
        {
            $image_name = ""; //SEtting DEfault Value as blank
        }

    $sql = "INSERT INTO product VALUES ('','$vendorID','$prodCat','$prodName','$prodDesc','$prodInv', '$prodPrice', '$instock', '$prodDisc' ,'$image_name')";

    $addProduct = mysqli_query($conn, $sql);

    if($addProduct == true)
    {
        //Data inserted Successfullly
        $_SESSION['addProd'] = "<div style='color: green' class='alert alert-success text-center'>Added Product Succesful.</div>";
        echo '<script>window.location.href = "manageProduct.php"</script>';
    }
    else
    {
       //Data inserted Failed
       $_SESSION['addProd'] = "<div style='color: red' class='alert alert-danger text-center'>Failed to Add Product.</div>";
       echo '<script>window.location.href = "manageProduct.php"</script>';
    }

}
?>



<?php
include 'templates/footer.php';
?>