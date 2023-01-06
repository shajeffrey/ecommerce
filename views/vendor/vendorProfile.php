<?php
include 'templates/vHomeHeader.php';

?>

<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h2 class="sessionName">Update Profile <?=$_SESSION['vendorName'];?></h2>
    </div>
</div>

<?php
if (isset($_SESSION['updateProfile'])) {
    echo $_SESSION['updateProfile'];
    unset($_SESSION['updateProfile']);

    $vendorID = $_SESSION['vendorID'];
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$vendorID' "));

    $_SESSION['vendorName'] = $row['vendorName'];
    $_SESSION['vendorEmail'] = $row['vendorEmail'];
    $_SESSION['vendorUsername'] = $row['vUsername'];
    $_SESSION['vendorPassword'] = $row['vPassword'];
    $_SESSION['vendorPhone'] = $row['vendorPhone'];
    $_SESSION['vendorLocation'] = $row['vendorLocation'];
    $_SESSION['qrUpload'] = $row['qrUpload'];
    $_SESSION['bankName'] = $row['bankName'];
    $_SESSION['bankNo'] = $row['bankNo'];
}
?>
<div class="m-4">
<div class="container sides ">
<form action="" method="post" class="">

<div class="container">
      <fieldset>
  
      <div class="row pt-2">

        <div class="col-12  col-sm-4">
          <legend class="legend1 "><span class="number"></span>Vendor Profile Info</legend>
          
        </div>

        <!-- ERROR CHECKING PLACE  -->
        <?php if (isset($_SESSION['updateProf'])): ?>
        <div class="col-12 col-sm-8">
            <div class="alert alert-danger text-center pt-2"  role="alert">
                <?php 
                echo $_SESSION['updateProf'];
                unset($_SESSION['updateProf']);
                ?>
            </div>
        </div>
        <?php endif; ?>

      </div>

      <hr>

      <div class="row">
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="vName">Vendor Name</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="text" class="input form-control" required name="vName" id="vName" value="<?php echo $_SESSION['vendorName']; ?>">
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="vUsername">Username</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="text" class="input form-control" required name="vUsername" id="vUsername" value="<?php echo $_SESSION['vendorUsername']; ?>">
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="vEmail">Email</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="email" class="input form-control" required name="vEmail" id="vEmail" value="<?php echo $_SESSION['vendorEmail']; ?>">
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="vPhone">Phone Number</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="number" class="input form-control" required name="vPhone" id="vPhone" value="<?php echo $_SESSION['vendorPhone']; ?>">
            </div>
        </div>

            <div class="col-12 ">
            <div class="form-group">
                <label for="vLocation">Location / Address</label>
                    <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <textarea class="input form-control" required rows="2" name="vLocation" id="vLocation"><?php echo $_SESSION['vendorLocation']; ?></textarea>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="vBankName">Bank Name</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="text" class="input form-control" required name="vBankName" id="vBankName" value="<?php echo $_SESSION['bankName']; ?>">
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="vBankNo">Bank Account No</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="number" class="input form-control" required name="vBankNo" id="vBankNo" value="<?php echo $_SESSION['bankNo']; ?>">
            </div>
        </div>




        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label class="labels" for="cPass">Enter Current Password</label>
                <input type="password" class=" input form-control" required name="cPass" id="cPass" value="">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label class="labels" for="changePass">Change Password</label>
                <input type="text" class=" input form-control" required name="changePass" id="changePass" value="">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label class="labels" for="confirmPass">Password Change Confirm</label>
                <input type="text" class=" input form-control" required name="confirmPass" id="confirmPass" value="">
            </div>
        </div>

      </div>

      </fieldset>
      

      <button class="buttonProfile my-4 py-3" name="updateProfile" type="submit">Update Profile</button>
      </div>    
    </form>

</div>

</div>


<?php
if (isset($_POST['updateProfile'])) {

  $vendorID = $_SESSION['vendorID'];
  $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$vendorID' "));
  $vendorPass = $row['vPassword'];

  $vName = $_POST['vName'];
  $vUsername = $_POST['vUsername'];
  $vEmail = $_POST['vEmail'];
  $vPhone = $_POST['vPhone'];
  $vLocation = $_POST['vLocation'];
  $vBankName = $_POST['vBankName'];
  $vBankNo = $_POST['vBankNo'];

  $cPass = $_POST['cPass'];
  $changePass = $_POST['changePass'];
  $confirmPass = $_POST['confirmPass'];

  $updateVendor= "UPDATE `vendor` SET 
  `vendorName`='$vName',
  `vendorEmail`='$vEmail',
  `vUsername`='$vUsername',
  `vPassword`='$confirmPass',
  `vendorPhone`='$vPhone',
  `vendorLocation`='$vLocation',
  `bankName`='$vBankName',
  `bankNo`='$vBankNo' WHERE vendorID='$vendorID'";
  
  $check1 = mysqli_query($conn, "SELECT vendorEmail FROM vendor WHERE vendorEmail='$vEmail' AND vendor!='$vendorID'");
  $check2 = mysqli_query($conn, "SELECT vUsername FROM vendor WHERE vUsername='$vUsername' AND vendor!='$vendorID'");
  $check3 = mysqli_query($conn, "SELECT vendorPhone FROM vendor WHERE vendorPhone='$vPhone' AND vendor!='$vendorID'");
  $check4 = mysqli_query($conn, "SELECT bankNo FROM vendor WHERE bankNo= '$vBankNo' AND vendor!='$vendorID'");


    if (mysqli_num_rows($check1) == 1) {
        $_SESSION['updateProf'] = "<div >Email already in Use!</div>";
        echo '<script>window.location.href = "vendorProfile.php"</script>';
    } else if (mysqli_num_rows($check2) == 1) {
        $_SESSION['updateProf'] = "<div >Username already in Use!</div>";
        echo '<script>window.location.href = "vendorProfile.php"</script>';

    } else if (mysqli_num_rows($check3) == 1) {
        $_SESSION['updateProf'] = "<div >Phone number already in Use!</div>";
        echo '<script>window.location.href = "vendorProfile.php"</script>';

    } else if (mysqli_num_rows($check4) == 1) {
        $_SESSION['updateProf'] = "<div >Bank number already in Use!</div>";
        echo '<script>window.location.href = "vendorProfile.php"</script>';

    } else if (strlen($vPhone) < 10 || strlen($vPhone) > 12) {
        $_SESSION['updateProf'] = "<div >Phone Number 10-12 digits!</div>";
        echo '<script>window.location.href = "vendorProfile.php"</script>';

    } else if (strlen($vBankNo) < 9 || strlen($vBankNo) > 17) {
        $_SESSION['updateProf'] = "<div >Bank No 9-17 digits!</div>";
        echo '<script>window.location.href = "vendorProfile.php"</script>';

    } 
    
    
    else if ($cPass != $vendorPass) {
      $_SESSION['updateProf'] = "<div >Wrong Current Password!</div>";
      echo '<script>window.location.href = "vendorProfile.php"</script>';

    } else if (strlen($changePass) < 6) {
        $_SESSION['updateProf'] = "<div >New Password length at least 6 letters</div>";
        echo '<script>window.location.href = "vendorProfile.php"</script>';

    } else if ($confirmPass != $changePass) {
      $_SESSION['updateProf'] = "<div >New Password Not Match!</div>";
      echo '<script>window.location.href = "vendorProfile.php"</script>';

    } else if (mysqli_query($conn, $updateVendor)) {
      $_SESSION['updateProfile'] = "<div style='color: green' class='alert alert-success text-center'>Update Profile Success</div>";
      echo '<script>window.location.href = "vendorProfile.php"</script>';
    } else {
      $_SESSION['updateProf'] = "<div style='color: red' class='alert alert-danger text-center'>Update Profile Unsuccessful</div>";
          echo '<script>window.location.href = "vendorProfile.php"</script>';
        
      mysqli_error($conn);
    }

  mysqli_close($conn);
  
}
?>

<?php
include 'templates/footer.php';
?>