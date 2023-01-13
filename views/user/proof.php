     
     <?php

include 'templates/uHomeHeader.php';

if (isset($_GET['oID'])) //Either use '&&' or 'AND'
{
    //Process to Delete

    $orderID = $_GET['oID'];
    
}
?>

<div style="background-color: #fff; border-radius:10px; width:50%;" class="container  px-4 mt-5">

<div class=" pt-4">
    
    <form method="post" id="contactFrm" enctype="multipart/form-data" >
        <fieldset >
            
            <div class="col-12 text-center">
                <h2 style="color:#007dd6;" >Upload Validation </h2>
            </div>
            
            
            <!-- ERROR CHECKING PLACE  -->
            <?php if (isset($_SESSION['errPic'])): ?>
                <div class="col-12 ">
                    <div class="alert alert-danger text-center pt-2"  role="alert">
                        <?php 
                echo $_SESSION['errPic'];
                unset($_SESSION['errPic']);
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
      
        <div class="col-12 text-center d-flex justify-content-center">
            <div class="form-group">
                <h4 for="proofPic">Transaction Verification</h4>
                <input type="file" class="form-control-file input2" required name="proofPic" id="proofPic" >
            </div>
        </div>
    

        <div class="col-6 text-center">
        <a class="buttonProfile my-4 py-3" href="payment.php" style="width:53%; color:white;"  name="proof" type="submit">Back To Payment</a>
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
    $proofPic = $_POST['proofPic'];

    date_default_timezone_set("Singapore");
    $pay_date = date("Y-m-d h:i:sa"); //Order DAte
    
    $queryPaid = "UPDATE userorder SET 
    paid='yes',
    paymentDate='$pay_date'
    WHERE userID='$userID' AND deleted='no' AND paid='no'";
    
    if (mysqli_query($conn, $queryPaid)) {
 
        $_SESSION['payError'] = "<div style='color: green' class='alert alert-success text-center'>Upload Succesful</div>";
        echo '<script>window.location.href = "payment.php"</script>';

    } else {
        $_SESSION['errPic'] = "<div style='color: red' class='alert alert-danger text-center'>Sorry Payment Validation Failed</div>";
        echo '<script>window.location.href = "proof.php"</script>';
        mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>

            
<?php
include 'templates/footer.php';
?>