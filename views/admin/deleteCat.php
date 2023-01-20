<!-- ADMIN DELETE CATEGORY -->
<?php include '../../conn.php';
session_start();
if (isset($_GET['deleteID'])) //Either use '&&' or 'AND'
{
    //Process to Delete
    $catID = $_GET['deleteID'];
    
    $catQuery = "UPDATE `category` SET 
    `catDel`='yes' WHERE `categoryID`='$catID'";

    $getCatDetails = mysqli_query($conn, $catQuery);

    if ($getCatDetails == true) {
        //Product Deleted
        $_SESSION['addCategory'] = "<div style='color: green' class='alert alert-success text-center'>Delete Category Successful.</div>";
        echo '<script>window.location.href = "adminCat.php"</script>';
    } else {
        $_SESSION['addCategory'] = "<div style='color: red' class='alert alert-danger text-center'>Delete Category Unsuccesful.</div>";
        echo '<script>window.location.href = "adminCat.php"</script>';
    }

} else {
    //Redirect to Manage Product Page
    //echo "REdirect";
    $_SESSION['addCategory'] = "<div style='color: red' class='alert alert-danger text-center'>Unauthorized Access</div>";
    echo '<script>window.location.href = "adminCat.php"</script>';
}

?>

