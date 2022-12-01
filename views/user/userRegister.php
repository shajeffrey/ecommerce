<?php include 'templates/header.php';?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-4 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
                <h3>User Register</h3>
                <hr>
                <form class="" action="/userRegister" method="post">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="uFullname">Full Name</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="uFullname" id="uFullname" value="<?php //set_value('uFullname')?>">
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="uEmail">Email</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="uEmail" id="uEmail" value="<?php //set_value('uEmail')?>">
                            </div>
                        </div>

                         <div class="col-12 ">
                            <div class="form-group">
                                <label for="uLocation">Location / Address</label>
                                 <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <textarea class="form-control" rows="3" name="uLocation" id="uLocation"><?php //set_value('uLocation')?></textarea>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="uPhone">Phone Number</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="uPhone" id="uPhone" value="<?php //set_value('uPhone')?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="uName">Username</label>
                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                <input type="text" class="form-control" name="uName" id="uName" value="<?php //set_value('uName')?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="uPass">Password</label>
                                <input type="password" class="form-control" name="uPass" id="uPass" value="">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="uConfirmPass">Confirm Password</label>
                                <input type="password" class="form-control" name="uConfirmPass" id="uConfirmPass" value="">
                            </div>
                        </div>

                        <!-- warnings -->
                        <?php /* if (isset($validation)): ?>

<div class="col-12">
<div class="alert alert-danger" role="alert">

<?=$validation->listErrors()?>

</div>
</div>

<?php endif; */?>



                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn " style="background-color:#007dd6; color:white;">Register</button>
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

<?php include 'templates/footer.php';?>