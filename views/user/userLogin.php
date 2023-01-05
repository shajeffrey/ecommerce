<?php

include 'templates/header.php';
include '../../controllers/login.php';

?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
                <h3>User Login</h3>
                <hr>
                <!-- SUCCESFULL REGISTER -->
                <?php if (isset($_SESSION['regisUser'])): ?>

                <div class="col-12">
                    <div class="alert alert-success text-center" role="alert">
                    <?php
                    echo $_SESSION['regisUser'];
                    unset($_SESSION['regisUser']);
                    ?>
                    </div>
                </div>

                <?php endif;?>

                <form class="" action="" method="post">
                    <div class="form-group">
                        <label for="custUsername">Username</label>
                        <!-- setvalue CI4 helper(['form']) in Users Controller -->
                        <input type="text" class="form-control" required name="custUsername" id="custUsername" value="<?php ?>">
                    </div>

                    <div class="form-group">
                        <label for="custPass">Password</label>
                        <input type="password" class="form-control" required name="custPass" id="custPass" value="">
                    </div>

                    <!--unsuccesful Login -->
                    <?php /* if (session()->getFlashdata('errorMessage')): ?>
<div class="col-12">
<div class="alert alert-danger" role="alert">
<?=session()->getFlashdata('errorMessage')?>
</div>
</div>
<?php endif; */?>

                      <!--validations to Login -->
                    <?php /* if (isset($validation)): ?>
<div class="col-12">
<div class="alert alert-danger" role="alert">

<?=$validation->listErrors()?>
</div>
</div>
<?php endif; */?>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" name="login" class="btn" style="background-color:#007dd6; color:white;">Login</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="userRegister.php" style="color:#007dd6; ">Have not yet registered?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'templates/footer.php';?>

<?php

if (isset($_REQUEST['login'])) {
    $users = new login();
    $users->userLogin($_REQUEST);
}

?>

