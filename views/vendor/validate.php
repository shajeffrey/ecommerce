     
     <?php

include 'templates/vHomeHeader.php';

if (isset($_GET['oID'])) //Either use '&&' or 'AND'
{
    //Process to Delete

    $orderID = $_GET['oID'];

    $vRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `userorder` WHERE orderID='$orderID' "));

    $currentPicture = $vRow['proof'];

    $userID = $vRow['userID'];

    $uRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE userID='$userID' "));
    $userName = $uRow['uName'];

    
}
?>

<div style="background-color: #fff; border-radius:10px; width:50%;" class="container  px-4 mt-5">

<div class=" pt-4">
    
    <form action="" method="post" enctype="multipart/form-data" >
        <fieldset >
            
            <div class="col-12 text-center">
                <h2 style="color:#007dd6;" >Approve Payment</h2>
            </div>
            
            
            <!-- ERROR CHECKING PLACE  -->

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

        <div class="col-6 text-center " >
            <div class="form-group">
                <h4 for="userName">User Name</h4>
                <input type="text" class="form-control-file input2 inactiveLink text-center" required name="userName" id="userName" value="<?=$userName?>" >
            </div>
        </div>
        <div class="col-6 text-center " >
            <div class="form-group">
                <h4 for="id">Order ID No. Reference</h4>
                <input type="text" class="form-control-file input2 inactiveLink text-center" required name="id" id="id" value="<?=$orderID?>" >
            </div>
        </div>

        <?php 
            //Check whether image available or not
            if(!empty($currentPicture)){
                ?>
                    <div class=" col-12 ">
                        <h4 class="text-center" >Users Proof of Payment</h4>
                        <div class="form-group d-flex justify-content-center">
                            <div class="" >
                                <img src="../../assets/images/proof/<?php echo $currentPicture; ?>" alt="Product Pic" width="100%" height="100%" class=" img-fluid">
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>

            <div class="col-4 text-center">
            <a class="buttonProfile btn my-4 py-3" href="orderPaid.php" style=" color:white;" >Back To Paid Orders</a>
            </div>

            <div class="col-4 text-center">
            <button class="buttonProfile2 my-4 py-3 btn btn-success" onclick="return confirm('Approve Payment Confirmation?');"    name="approve" type="submit">Approve</button>
            </div>
            
            <div class="col-4 text-center">
            <button class="buttonProfile2 my-4 py-3 btn btn-danger" onclick="return confirm('Reject Payment Confirmation?');"  name="reject" type="submit">Reject</button>
            </div>

    </div>

        
    </fieldset>
    
    </form>
  

  </div>  
  </div>


  <?php
if (isset($_POST['approve'])) {

        $orderID = $_POST['id'];
        // $proofPic = $_POST['proofPic'];

    $updateQuery= "UPDATE `userorder` SET `approved`='yes' WHERE orderID='$orderID'";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['approve'] = "<div style='color: green' class='alert alert-success text-center'>Approve Payment Succesful.</div>";
        echo '<script>window.location.href = "orderPaid.php"</script>';
       
    } else {
        $_SESSION['updateErr'] = "<div style='color: red' class='alert alert-danger text-center'>Approve Payment  Unsuccesful.</div>";
        echo '<script>window.location.href = "validate.php"</script>';
      
        mysqli_error($conn);
        die();
    }
    mysqli_close($conn);
    
}
?>

  <?php
if (isset($_POST['reject'])) {

        $orderID = $_POST['id'];
        // $proofPic = $_POST['proofPic'];

    $updateQuery= "UPDATE `userorder` SET 
    `paid`='no',`approved`='no' WHERE orderID='$orderID'";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['reject'] = "<div style='color: green' class='alert alert-success text-center'>Reject Payment Succesful.</div>";
        echo '<script>window.location.href = "orderPaid.php"</script>';
       
    } else {
        $_SESSION['updateErr'] = "<div style='color: red' class='alert alert-danger text-center'>Reject Payment Unsuccessful</div>";
        echo '<script>window.location.href = "validate.php"</script>';
      
        mysqli_error($conn);
        die();
    }
    mysqli_close($conn);
    
}
?>

            
<?php
include 'templates/footer.php';
?>