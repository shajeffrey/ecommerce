
<?php include '../../conn.php';
session_start();
if(isset($_GET['deleteID']) && isset($_GET['currentImage'])) //Either use '&&' or 'AND'
{
    //Process to Delete

    $deleteID = $_GET['deleteID'];
    $prodImage = $_GET['currentImage'];
    //CHeck whether the image is available or not and Delete only if available
    if($prodImage != "")
    {
        //Get the Image Path
        $path = "../../assets/images/product/".$prodImage;
        //REmove Image File from Folder
        $remove = unlink($path);
    }

    //Delete Prod from Database
    $query = "DELETE FROM `product` WHERE productID='$deleteID'";
    //Execute the Query
    $deleteProd = mysqli_query($conn, $query);

    if($deleteProd==true)
    {
        //Product Deleted
        $_SESSION['deleteProd'] = "<div style='color: green' class='alert alert-success text-center'>Delete Successful.</div>";
        echo '<script>window.location.href = "manageProduct.php"</script>';
    }else{
        $_SESSION['deleteProd'] = "<div style='color: red' class='alert alert-danger text-center'>Delete Unsuccesful.</div>";
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


