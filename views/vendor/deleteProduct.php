<!-- VNDOR DELETE PRODUCT -->
<?php include '../../conn.php';
session_start();
if(isset($_GET['deleteID']) && isset($_GET['currentImage'])) //Either use '&&' or 'AND'
{
    //Process to Delete

    
    $deleteID = $_GET['deleteID'];
    $prodImage = $_GET['currentImage'];


    $query = "SELECT * 
    FROM product 
    JOIN cart ON product.productID = cart.productID 
    JOIN userorder ON cart.orderID = userorder.orderID
    WHERE product.productID='$deleteID' AND userorder.deleted='no' AND userorder.fulfilled='no' ";

    $cartList = mysqli_query($conn, $query);
    //Count Rows to check whether we have foods or not
    $count = mysqli_num_rows($cartList);

    if($count == 0){
    //CHeck whether the image is available or not and Delete only if available
     

        //Delete Prod from Database
        $query = "DELETE FROM `product` WHERE productID='$deleteID'";
        //Execute the Query
        $deleteProd = mysqli_query($conn, $query);

        if($deleteProd==true)
        {
            if($prodImage != "")
            {
                //Get the Image Path
                $path = "../../assets/images/product/".$prodImage;
                //REmove Image File from Folder
                $remove = unlink($path);
            }
            //Product Deleted
            $_SESSION['deleteProd'] = "<div style='color: green' class='alert alert-success text-center'>Delete Successful.</div>";
            echo '<script>window.location.href = "manageProduct.php"</script>';
        }else{
            $_SESSION['deleteProd'] = "<div style='color: red' class='alert alert-danger text-center'>Delete Unsuccesful.</div>";
            echo '<script>window.location.href = "manageProduct.php"</script>';
        }
    }else{
        $_SESSION['deleteProd'] = "<div style='color: red' class='alert alert-danger text-center'>Deletion Cancelled! There are customer Cart Orders related to item</div>";
        echo '<script>window.location.href = "manageProduct.php"</script>';
    }
}
else
{
    //Redirect to Manage Product Page
    //echo "REdirect";
    $_SESSION['deleteProd'] = "<div style='color: red' class='alert alert-danger text-center'>Unauthorized Access</div>";
    echo '<script>window.location.href = "manageProduct.php"</script>';
}

?>


