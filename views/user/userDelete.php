<!-- USER DELETE ORDERS -->
<?php include '../../conn.php';
session_start();
if (isset($_GET['deleteID'])) //Either use '&&' or 'AND'
{
    //Process to Delete

    $cartID = $_GET['deleteID'];
    
    $cartQuery = "SELECT * FROM cart
    INNER JOIN product ON cart.productID = product.productID
    INNER JOIN userorder ON cart.orderID = userorder.orderID
    WHERE cart.cartID='$cartID'";

    $getCartDetails = mysqli_query($conn, $cartQuery);
    
    if ($getCartDetails == false) {

        $_SESSION['updateCart'] = "<div style='color: red' class='alert alert-danger text-center'>1st Failed.</div>";
        //echo '<script>window.location.href = "userCart.php"</script>';
        
        mysqli_error($conn);
        
        die();
    }

    $row = mysqli_fetch_assoc($getCartDetails);


    $orderID = $row['orderID'];
    $deletedYes = 'yes';

    $productID = $row['productID'];
    $inventoryNo = $row['inventoryNo'];
    $inStock = $row['inStock'];

    $quantity = $row['quantity'];

    // update + quantity in product inv
    // update if stockLeft > 0 = inStock = yes
    $stockLeft = $inventoryNo + $quantity;
    if ($stockLeft > 0) {
        $inStock = 'yes';
    }

    $updateProduct = "UPDATE `product` SET
    `inStock`='$inStock',
    `inventoryNo`='$stockLeft' WHERE productID='$productID'";

    $updateProd = mysqli_query($conn, $updateProduct);

    if ($updateProd == false) {

        $_SESSION['updateProd'] = "<div style='color: red' class='alert alert-danger text-center'>Product Inv Updated Failed.</div>";
        echo '<script>window.location.href = "userCart.php"</script>';
        
        mysqli_error($conn);
        
    } 

    date_default_timezone_set("Singapore");
    $del_date = date("Y-m-d h:i:sa"); //Order DAte
    //make order a deleted entry
    // update set orderID to deleted == yes
    $updateOrder = "UPDATE `userorder` SET
    `deleted`='$deletedYes', `deleteDate`='$del_date' WHERE orderID='$orderID'";
    //Execute the Query
    $deleteProd = mysqli_query($conn, $updateOrder);

    if ($deleteProd == true) {
        //Product Deleted
        $_SESSION['deleteOrder'] = "<div style='color: green' class='alert alert-success text-center'>Delete Order Successful.</div>";
        echo '<script>window.location.href = "userCart.php"</script>';
    } else {
        $_SESSION['deleteOrder'] = "<div style='color: red' class='alert alert-danger text-center'>Delete Order Unsuccesful.</div>";
        echo '<script>window.location.href = "userCart.php"</script>';
    }
} else {
    //Redirect to Manage Product Page
    //echo "REdirect";
    $_SESSION['deleteOrder'] = "<div style='color: red' class='alert alert-danger text-center'>Unauthorized Access</div>";
    echo '<script>window.location.href = "userCart.php"</script>';
}

?>


