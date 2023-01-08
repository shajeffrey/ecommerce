<?php
include 'templates/aHomeHeader.php';
?>


<!-- margin y axis (top/bottom) -->
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Manage Categories</h1>
    </div>
</div>

<div class="container-fluid bg-light">
<?php 
if (isset($_SESSION['addCategory'])) {
    echo $_SESSION['addCategory'];
    unset($_SESSION['addCategory']);
}
?>
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-sm-6  " >
                <div class="m-4">
                    <div class="container-fluid sides" >
                        <form action="" method="post" class="">
                            <div class="container">

                                <fieldset>

                                    <div class="row pt-2">
                                        <div class="col-12  col-sm-5">
                                        <legend class="legend1 ">Add Category</legend>
                                        </div>

                                        <!-- ERROR CHECKING PLACE  -->
                                        <?php if (isset($_SESSION['addCat'])): ?>
                                        <div class="col-12 col-sm-7">
                                            <div class="alert alert-danger text-center pt-2"  role="alert">
                                                <?php 
                                                echo $_SESSION['addCat'];
                                                unset($_SESSION['addCat']);
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
                                                <input type="text" class=" input form-control" placeholder="*Enter a name" maxlength="50" required name="catName" id="catName" value="<?php if(isset($_SESSION['catName'])) { echo $_SESSION['catName']; unset($_SESSION['catName']);}?>">

                                            </div>
                                        </div>

                                        <div class="col-12 ">
                                            <div class="form-group">
                                                <label class="labels" for="catDesc">Category Description</label>
                                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                                <textarea class=" input form-control" placeholder="*90 characters" required rows="3" maxlength="90" name="catDesc" id="catDesc"><?php if(isset($_SESSION['catDesc'])) { echo $_SESSION['catDesc']; unset($_SESSION['catDesc']);}?></textarea>
                                            </div>
                                        </div>
                                   
                                        <button class="buttonProfile my-4 py-3 " name="addCat" type="submit">Add Category</button>
                                </fieldset>
                                
                               
                            </div>    
                        </form>

                    </div>

                </div>
            </div>

            <hr>

            <div class="col-12 col-sm-6 ">
                    
                    <div style="background-color: #fff;" class="mt-4 sides2" >

                    <h4 style="color:#be0000;" class="p-1">Manage Product Categories</h4>
                    <br>       
                        <table class="table ">
                        <thead>
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 15px;">
                        <?php 
                            $query = "SELECT * FROM category WHERE catDel='no' ORDER BY `categoryID` ASC";
                            $getCategory = mysqli_query($conn, $query);
                            $count = mysqli_num_rows($getCategory);
                            $sn=1;

                            if($count>0)
                            {
                                //We have food in Database
                                //Get the Foods from Database and Display
                                while($row=mysqli_fetch_assoc($getCategory))
                                {
                                    $categoryID = $row['categoryID'];
                                    $categoryName = $row['categoryName'];
                                    $categoryDesc = $row['categoryDesc'];
   
                            ?>
                            <tr>

                            <th scope="row"><?php echo $sn++; ?></th>
                            <td><?php echo$categoryName?></td>
                            <td><?php echo$categoryDesc?></td>
                            <td >
                                <a href="updateCat.php?updateID=<?php echo $categoryID;?>" class=" btn-link">Update</a>
                                <a onclick="return confirm('Are you sure you want to delete this product?');" href="deleteCat.php?deleteID=<?php echo $categoryID;?>" class=" btn-link">Delete</a>
                            </td>
                         
                            </tr>

                            <?php
                                }
                            }
                            else
                            {
                                //Food not Added in Database
                                echo "<tr> <td colspan='12' class='text-center'> No Category Added . </td> </tr>";
                            }

                            ?>
                        </tbody>
                        </table>
                    </div>
            </div>
        
        </div>
    </div>
</div>

<?php    
if(isset($_POST['addCat'])){

    $catName = $_POST['catName'];
    $catDesc = $_POST['catDesc'];

    $check1 = mysqli_query($conn, "SELECT * FROM category WHERE categoryName='$catName' AND catDel='no'");
    $check2 = mysqli_query($conn, "SELECT * FROM category WHERE categoryName LIKE '%$catName%' AND catDel='no'");

    $sql = "INSERT INTO category VALUES ('','$catName','$catDesc','no')";

    if (mysqli_num_rows($check1) > 0) {
        $_SESSION['addCat'] = "<div >Category already in Use!</div>";
        $_SESSION['catName'] = $catName;
        $_SESSION['catDesc'] = $catDesc;
        echo '<script>window.location.href = "adminCat.php"</script>';

    } if (mysqli_num_rows($check2) > 0) {
        $_SESSION['addCat'] = "<div >A Similar Category already in Use!</div>";
        $_SESSION['catName'] = $catName;
        $_SESSION['catDesc'] = $catDesc;
        echo '<script>window.location.href = "adminCat.php"</script>';

    } else if(mysqli_query($conn, $sql)){
        //Data inserted Successfullly
        $_SESSION['addCategory'] = "<div style='color: green' class='alert alert-success text-center'>Category Added Success</div>";
        echo '<script>window.location.href = "adminCat.php"</script>';
    }
    else {
       //Data inserted Failed
       $_SESSION['addCat'] = "<div >Add Category Unsuccessful</div>";
       echo '<script>window.location.href = "adminCat.php"</script>';
    }
}
?>


<?php
include 'templates/footer.php';
?>
