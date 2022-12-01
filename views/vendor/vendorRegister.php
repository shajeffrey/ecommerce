<?php include 'templates/header.php';?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-2 mt-5 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
                <h3>Vendor Register</h3>
                <hr>

                <form class="" action="/vendorRegister" method="post">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vName">Vendor Name</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="vName" id="vName" value="<?php //set_value('vName')?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vEmail">Email</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="vEmail" id="vEmail" value="<?php //set_value('vEmail')?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vPhone">Phone Number</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="vPhone" id="vPhone" value="<?php //set_value('vPhone')?>">
                            </div>
                        </div>

                         <div class="col-12 ">
                            <div class="form-group">
                                <label for="vLocation">Location / Address</label>
                                 <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <textarea class="form-control" rows="2" name="vLocation" id="vLocation"><?php //set_value('vLocation')?></textarea>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="vBankName">Vendor Bank Name</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="vBankName" id="vBankName" value="<?php //set_value('vBankName')?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="vBankNo">Bank Account No</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="vBankNo" id="vBankNo" value="<?php //set_value('vBankNo')?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vUsername">Vendor Username</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="vUsername" id="vUsername" value="<?php //set_value('vUsername')?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vPass">Vendor Password</label>
                                <input type="password" class="form-control" name="vPass" id="vPass" value="">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="vConfirmPass">Confirm Password</label>
                                <input type="password" class="form-control" name="vConfirmPass" id="vConfirmPass" value="">
                            </div>
                        </div>

                         <!-- warnings -->
                         <?php /*if (isset($validation)): ?>

                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">

                                <?=$validation->listErrors()?>

                            </div>
                        </div>

                        <?php endif; */ ?>

                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn " style="background-color:#6A0DAD; color:white;">Register</button>
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

<?php include 'templates/footer.php';?>