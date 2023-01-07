<?php
include 'templates/aHomeHeader.php';
?>

<?php
if (isset($_GET['updateID'])) {

    $catID = $_GET['updateID'];

    $query = "SELECT * FROM `category` WHERE categoryID='$catID' ";

    $getCat = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($getCat);

    $catName = $row['categoryName'];
    $catDesc = $row['categoryDesc'];

} else {
    //If not found redirect to vendorhomepage
    $_SESSION['addCategory'] = "<div style='color: red' class='alert alert-danger text-center'>Sorry! Category Not Found</div>";
    echo '<script>window.location.href = "adminCat.php"</script>';
}
?>

<!-- margin y axis (top/bottom) -->
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Update Category</h1>
    </div>
</div>

<div class="container-fluid bg-light">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 " >
                <div class="m-4">
                    <div class="container-fluid sides3" >
                        <form action="" method="post" class="">
                            <div class="container">

                                <fieldset>

                                    <div class="row pt-2">
                                        <div class="col-12 text-center">
                                        <legend class="legend1 "><?php echo $catName;?> Category</legend>
                                        </div>

                                        <!-- ERROR CHECKING PLACE  -->
                                        <?php if (isset($_SESSION['updateCat'])): ?>
                                        <div class="col-12 ">
                                            <div class="alert alert-danger text-center pt-2"  role="alert">
                                                <?php 
                                                echo $_SESSION['updateCat'];
                                                unset($_SESSION['updateCat']);
                                                ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                <hr>
                          
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="labels" for="catName">Category Name</label>
                                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                                <input type="text" class=" input form-control" placeholder="*Enter a name" maxlength="50" required name="catName" id="catName" value="<?php echo $catName;?>">

                                            </div>
                                        </div>

                                        <div class="col-12 ">
                                            <div class="form-group">
                                                <label class="labels" for="catDesc">Category Description</label>
                                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                                <textarea class=" input form-control" placeholder="*90 characters" required rows="3" maxlength="90" name="catDesc" id="catDesc"><?php echo $catDesc;?></textarea>
                                            </div>
                                        </div>
                                   
                                        <button class="buttonProfile my-4 py-3 " name="updateCate" type="submit">Update Category</button>
                                </fieldset>
                                
                               
                            </div>    
                        </form>

                    </div>

                </div>
            </div>
        
        </div>
    </div>
</div>

<?php    
if(isset($_POST['updateCate'])){

    $catName = $_POST['catName'];
    $catDesc = $_POST['catDesc'];

    $check1 = mysqli_query($conn, "SELECT * FROM category WHERE categoryName='$catName' OR categoryName LIKE '%$catName%' AND categoryID!='$catID' ");

    $sql = "UPDATE `category` SET 
    `categoryName`='$catName',
    `categoryDesc`='$catDesc' WHERE `categoryID`='$catID'";

    if (mysqli_num_rows($check1) > 0) {
        $_SESSION['addCategory'] = "<div style='color: red' class='alert alert-danger text-center'>Update Category already in Use!</div>";
        echo '<script>window.location.href = "adminCat.php"</script>';

    } else if(mysqli_query($conn, $sql)){
        //Data inserted Successfullly
        $_SESSION['addCategory'] = "<div style='color: green' class='alert alert-success text-center'>Category Added Success</div>";
        echo '<script>window.location.href = "adminCat.php"</script>';
    }
    else {
       //Data inserted Failed
       $_SESSION['addCategory'] = "<div style='color: red' class='alert alert-danger text-center'>Update Category Unsuccessful</div>";
       echo '<script>window.location.href = "adminCat.php"</script>';
    }
}
?>


<?php
include 'templates/footer.php';
?>
