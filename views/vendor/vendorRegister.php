<?php
include 'templates/header.php';
include '../../controllers/register.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-2 mt-5 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
                <h3>Vendor Register</h3>
                <hr>

                <form class="" action="" method="post">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vName">Vendor Name</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" required name="vName" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" id="vName" value="<?php if(isset($_SESSION['vName'])) { echo $_SESSION['vName']; unset($_SESSION['vName']);}?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vEmail">Email</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="email" class="form-control" required name="vEmail" id="vEmail" value="<?php if(isset($_SESSION['vEmail'])) { echo $_SESSION['vEmail']; unset($_SESSION['vEmail']);}?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vPhone">Phone Number</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="number" class="form-control" required name="vPhone" id="vPhone" value="<?php if(isset($_SESSION['vPhone'])) { echo $_SESSION['vPhone']; unset($_SESSION['vPhone']);}?>">
                            </div>
                        </div>

                         <div class="col-12 ">
                            <div class="form-group">
                                <label for="vLocation">Location / Address</label>
                                 <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <textarea class="form-control" required rows="2" name="vLocation" id="vLocation"><?php if(isset($_SESSION['vLocation'])) { echo $_SESSION['vLocation']; unset($_SESSION['vLocation']);}?></textarea>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="vBankName">Vendor Bank Name</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" required name="vBankName" id="vBankName" value="<?php if(isset($_SESSION['vBankName'])) { echo $_SESSION['vBankName']; unset($_SESSION['vBankName']);}?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="vBankNo">Bank Account No</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="number" class="form-control" required name="vBankNo" id="vBankNo" value="<?php if(isset($_SESSION['vBankNo'])) { echo $_SESSION['vBankNo']; unset($_SESSION['vBankNo']);}?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vUsername">Vendor Username</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" required name="vUsername" id="vUsername" value="<?php if(isset($_SESSION['vUsername'])) { echo $_SESSION['vUsername']; unset($_SESSION['vUsername']);}?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vPass">Vendor Password</label>
                                <input type="password" class="form-control" required name="vPass" id="vPass" value="">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vConfirmPass">Confirm Password</label>
                                <input type="password" class="form-control" required name="vConfirmPass" id="vConfirmPass" value="">
                            </div>
                        </div>

                         <!-- warnings -->
                         <?php if (isset($_SESSION['regisVendor'])): ?>

                            <div class="col-12">
                                <div class="alert alert-danger text-center" role="alert">
                                <?php 
                                echo $_SESSION['regisVendor'];
                                unset($_SESSION['regisVendor']);
                                ?>
                                </div>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn " name="register" style="background-color:#6A0DAD; color:white;">Register</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                        <a href="vendorLogin.php" style="color:#6A0DAD;">Already have an account?</a>

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
    $users->vendorRegis($_REQUEST);
}



?>