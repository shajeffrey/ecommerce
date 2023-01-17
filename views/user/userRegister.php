<?php
include 'templates/header.php';
include '../../controllers/register.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-4 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
                <h3>User Register</h3>
                <hr>
                <form class="" action="" method="post">
                    <div class="row">

                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="uFullname">Full Name</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" required name="uFullname" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" id="uFullname" value="<?php if(isset($_SESSION['uFullname'])) { echo $_SESSION['uFullname']; unset($_SESSION['uFullname']);} ?>">
                            
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="uEmail">Email</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="email" class="form-control" required name="uEmail" id="uEmail" value="<?php if(isset($_SESSION['uEmail'])) { echo $_SESSION['uEmail']; unset($_SESSION['uEmail']);}?>">
                            </div>
                        </div>

                         <div class="col-12 ">
                            <div class="form-group">
                                <label for="uLocation">Location / Address</label>
                                 <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <textarea class="form-control" required rows="3" name="uLocation" id="uLocation"><?php if(isset($_SESSION['uLocation'])) { echo $_SESSION['uLocation']; unset($_SESSION['uLocation']);}?></textarea>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="uPhone">Phone Number</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="number" class="form-control" required name="uPhone" id="uPhone" value="<?php if(isset($_SESSION['uPhone'])) { echo $_SESSION['uPhone']; unset($_SESSION['uPhone']);}?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="uName">Username</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" required name="uName" id="uName" value="<?php if(isset($_SESSION['uName'])) { echo $_SESSION['uName']; unset($_SESSION['uName']);}?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="uPass">Password</label>
                                <input type="password" class="form-control" required name="uPass" id="uPass" value="">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="uConfirmPass">Confirm Password</label>
                                <input type="password" class="form-control" required name="uConfirmPass" id="uConfirmPass" value="">
                            </div>
                        </div>

                        <!-- warnings -->
                        <?php if (isset($_SESSION['regisUser'])): ?>

                        <div class="col-12">
                            <div class="alert alert-danger text-center" role="alert">
                            <?php
                            echo $_SESSION['regisUser'];
                            unset($_SESSION['regisUser']);
                            ?>
                            </div>
                        </div>

                        <?php endif;?>

                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn " name="register" style="background-color:#007dd6; color:white;">Register</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="userLogin.php" style="color:#007dd6;">Already have an account?</a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'templates/footer.php';

if (isset($_REQUEST['register'])) {
    $users = new register();
    $users->userRegis($_REQUEST);
}

?>