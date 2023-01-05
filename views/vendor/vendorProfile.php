<?php
include 'templates/vHomeHeader.php';

?>

<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h2 class="sessionName">Update Profile <?=$_SESSION['userName'];?></h2>
    </div>
</div>

<?php
if (isset($_SESSION['updateProfile'])) {
    echo $_SESSION['updateProfile'];
    unset($_SESSION['updateProfile']);

    $vendorID = $_SESSION['vendorID'];
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vendor` WHERE vendorID='$uID' "));

    $_SESSION['userFullname'] = $row['fullName'];
    $_SESSION['userName'] = $row['uName'];
    $_SESSION['userPass'] = $row['uPass'];
    $_SESSION['userEmail'] = $row['userEmail'];
    $_SESSION['userPhone'] = $row['userPhone'];
    $_SESSION['userLocation'] = $row['userLocation'];
}
?>
<div class="m-4">
<div class="container " style="background-color: whitesmoke;">
<form action="" method="post" class="">

<div class="container">
      <fieldset>
  
      <div class="row py-2">

        <div class="col-12  col-sm-4">
          <legend class="legend1 py-1"><span class="number"></span>Your Profile Info</legend>
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

      <div class="row">

        <div class="col-12  col-sm-6">
            <div class="form-group">
                <label class="labels" for="uFullname">Full Name</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="text" class=" input form-control" required name="uFullname" id="uFullname" value="<?php echo $_SESSION['userFullname']; ?>">

            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label class="labels" for="uName">Username</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="text" class=" input form-control" required name="uName" id="uName" value="<?php echo $_SESSION['userName']; ?>">
            </div>
        </div>

          <div class="col-12 ">
            <div class="form-group">
                <label class="labels" for="uLocation">Location / Address</label>
                  <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <textarea class=" input form-control" required rows="3" name="uLocation" id="uLocation"><?php echo $_SESSION['userLocation']; ?></textarea>
            </div>
        </div>

        <div class="col-12  col-sm-6 ">
            <div class="form-group">
                <label class="labels" for="uEmail">Email</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="email" class=" input form-control" required name="uEmail" id="uEmail" value="<?php echo $_SESSION['userEmail']; ?>">
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label class="labels" for="uPhone">Phone Number</label>
                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                <input type="number" class=" input form-control" required name="uPhone" id="uPhone" value="<?php echo $_SESSION['userPhone']; ?>">
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

  $userID = $_SESSION['userID'];
  $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `user` WHERE userID='$userID' "));
  $userPass = $row['uPass'];

  $uFullname = $_POST['uFullname'];
  $uName = $_POST['uName'];
  $uLocation = $_POST['uLocation'];
  $uEmail = $_POST['uEmail'];
  $uPhone = $_POST['uPhone'];
  $cPass = $_POST['cPass'];
  $changePass = $_POST['changePass'];
  $confirmPass = $_POST['confirmPass'];
  
  $updateUser= "UPDATE `user` SET
  `fullName`='$uFullname',
  `uName`='$uName',
  `uPass`='$confirmPass',
  `userEmail`='$uEmail',
  `userPhone`='$uPhone',
  `userLocation`='$uLocation' WHERE userID='$userID'";
  
  $query1 = mysqli_query($conn, "SELECT userEmail FROM user WHERE userEmail='$uEmail' AND userID!='$userID'");
  $query2 = mysqli_query($conn, "SELECT uName FROM user WHERE uName='$uName' AND userID!='$userID'");
  $query3 = mysqli_query($conn, "SELECT userPhone FROM user WHERE userPhone='$uPhone' AND userID!='$userID'");


    if (mysqli_num_rows($query1) == 1) {
        $_SESSION['updateProf'] = "<div >Email already in Use!</div>";
        echo '<script>window.location.href = "userProfile.php"</script>';
    } else if (mysqli_num_rows($query2) == 1) {
        $_SESSION['updateProf'] = "<div >Username already in Use!</div>";
        echo '<script>window.location.href = "userProfile.php"</script>';

    } else if (mysqli_num_rows($query3) == 1) {
        $_SESSION['updateProf'] = "<div >Phone number already in Use!</div>";
        echo '<script>window.location.href = "userProfile.php"</script>';

    } else if (strlen($uPhone) < 10 || strlen($uPhone) > 12) {
        $_SESSION['updateProf'] = "<div >Phone Number 10-12 digits!</div>";
        echo '<script>window.location.href = "userProfile.php"</script>';

    } else if ($cPass != $userPass) {
      $_SESSION['updateProf'] = "<div >Wrong Current Password!</div>";
      echo '<script>window.location.href = "userProfile.php"</script>';

    } else if (strlen($changePass) < 6) {
        $_SESSION['updateProf'] = "<div >New Password length at least 6 letters</div>";
        echo '<script>window.location.href = "userProfile.php"</script>';

    } else if ($confirmPass != $changePass) {
      $_SESSION['updateProf'] = "<div >New Password Not Match!</div>";
      echo '<script>window.location.href = "userProfile.php"</script>';

    } else if (mysqli_query($conn, $updateUser)) {
      $_SESSION['updateProfile'] = "<div style='color: green' class='alert alert-success text-center'>User Update Success</div>";
      echo '<script>window.location.href = "userProfile.php"</script>';
    } else {
      $_SESSION['updateProf'] = "<div style='color: red' class='alert alert-danger text-center'>Update Profile Unsuccessful</div>";
          echo '<script>window.location.href = "userProfile.php"</script>';
        
      mysqli_error($conn);
    }

  mysqli_close($conn);
  
}
?>


<?php
include 'templates/footer.php';
?>