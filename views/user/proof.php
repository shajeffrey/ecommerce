     
     <?php

include 'templates/uHomeHeader.php';

if (isset($_GET['oID'])) //Either use '&&' or 'AND'
{
    //Process to Delete

    $orderID = $_GET['oID'];

    $vRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `userorder` WHERE orderID='$orderID' "));
    $currentPicture = $vRow['proof'];

    
}
?>

<div style="background-color: #fff; border-radius:10px; width:50%;" class="container  px-4 mt-5">

<div class=" pt-4">
    
    <form action="" method="post" enctype="multipart/form-data" >
        <fieldset >
            
            <div class="col-12 text-center">
                <h2 style="color:#007dd6;" >Upload Validation </h2>
            </div>
            
            
            <!-- ERROR CHECKING PLACE  -->
            <?php if (isset($_SESSION['updateProduct'])): ?>
                <div class="col-12 ">
                    <div class="alert alert-danger text-center pt-2"  role="alert">
                        <?php 
                echo $_SESSION['updateProduct'];
                unset($_SESSION['updateProduct']);
                ?>
            </div>
        </div>
        <?php endif; ?>
            <?php if (isset($_SESSION['updateErr'])): ?>
                <div class="col-12 ">
                    <div class="alert alert-danger text-center pt-2"  role="alert">
                        <?php 
                echo $_SESSION['updateErr'];
                unset($_SESSION['updateErr']);
                ?>
            </div>
        </div>
        <?php endif; ?>
        
        <hr>
        
        
        <div class=" row">

        <div class="col-12 text-center d-flex justify-content-center" >
            <div class="form-group">
                <h4 for="id">Order ID No. Reference</h4>
                <input type="text" class="form-control-file input2 inactiveLink text-center" style="width:100%;" required name="id" id="id" value="<?=$orderID?>" >
            </div>
        </div>

        <?php 
            //Check whether image available or not
            if(!empty($currentPicture))
            {
                //Image not Available
                ?>
            <h4 class="text-center" >Your Current Upload</h4>
            <div class=" inner-update2">
                <div class="image-holder-update2 d-flex justify-content-center" >
                <img src="../../assets/images/proof/<?php echo $currentPicture; ?>" alt="Product Pic" width="100%" height="100%" class=" img-fluid">
                </div>
                </div>
  
                <?php
                //echo "<div class='error'>Image not available.</div>";
            }
        ?>

        
        <div class="col-12 text-center d-flex mt-2 justify-content-center">
            <div class="form-group">
            <h4 for="proofPic">Transaction Verification</h4>
                <input type="file" class="form-control-file input2" required name="proofPic" id="proofPic" >
            </div>
        </div>
    

        <div class="col-6 text-center">
        <a class="buttonProfile btn my-4 py-3" href="payment.php" style="width:53%; color:white;" >Back To Payment</a>
        </div>

        <div class="col-6 text-center">
        <button class="buttonProfile my-4 py-3" style="width:53%;"  name="proof" type="submit">Upload</button>
        </div>

    </div>

        
    </fieldset>
    
    </form>
  

  </div>  
  </div>


  <?php
if (isset($_POST['proof'])) {

        $orderID = $_POST['id'];
        // $proofPic = $_POST['proofPic'];
    
        if(isset($_FILES['proofPic']['name']))
        {
            //Upload BUtton Clicked
            $image_name = $_FILES['proofPic']['name']; //New Image NAme

            //CHeck whether th file is available or not
            if($image_name!="")
            {
                //IMage is Available
                //A. Uploading New Image
                //REname the Image
                $tmp = explode('.', $image_name); //Gets the extension of the image
                $fileExt = end($tmp); //Gets the extension of the image

                $image_name = "proof-".rand(000000, 999999).'.'.$fileExt; //THis will be renamed image

                //Get the Source Path and DEstination PAth
                $src_path = $_FILES['proofPic']['tmp_name']; //Source Path
                $dest_path = "../../assets/images/proof/".$image_name; //DEstination Path
                //Upload the image
                $upload = move_uploaded_file($src_path,$dest_path);
                /// CHeck whether the image is uploaded or not
                if($upload==false)
                {
                    //FAiled to Upload
                $_SESSION['updateProduct'] = "<div>sorry file not Uploaded</div>";
                    //REdirect to Manage Food 
                    echo '<script>window.location.href =  window.location.href</script>';
                    //Stop the Process
                    die();
                }
                //3. Remove the image if new image is uploaded and current image exists
                //B. Remove current Image if Available
                if(!empty($currentPicture))
                {
                    //Current Image is Available
                    //REmove the image
                    $remove_path = "../../assets/images/proof/".$currentPicture;

                    $remove = unlink($remove_path);
                    //Check whether the image is removed or not
                    if($remove==false)
                    {
                        //failed to remove current image
                        $_SESSION['updateProduct'] = "<div>Failed to remove current Image</div>";
                        //redirect to manage food
                        echo '<script>window.location.href = window.location.href</script>';
                        //stop the process
                        die();
                    }
                }
            }
            else
            {
                $image_name = $currentPicture; //Default Image when Image is Not Selected
            }
        }
        else
        {
            $image_name = $currentPicture; //Default Image when Button is not Clicked

        }

    $updateQuery= "UPDATE `userorder` SET 
    `proof`='$image_name',`approved`='' WHERE orderID='$orderID'";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['payError'] = "<div style='color: green' class='alert alert-success text-center'>Upload Succesful.</div>";
        echo '<script>window.location.href = "payment.php"</script>';
       
    } else {
        $_SESSION['updateErr'] = "<div style='color: red' class='alert alert-danger text-center'>Upload Unsuccesful.</div>";
        echo '<script>window.location.href = "proof.php"</script>';
      
        mysqli_error($conn);
    }
    mysqli_close($conn);
    
}
?>

            
<?php
include 'templates/footer.php';
?>