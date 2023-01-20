<!-- ADMIN LOGIN PAGE -->
<?php
include 'templates/header.php';
include '../../controllers/login.php';
?>


<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
                <h3>Admin Login</h3>
                <hr>

                <form class="" action="" method="post">
                    <div class="form-group">
                        <label for="adminUsername">Username</label>
                        <!-- setvalue CI4 helper(['form']) in Users Controller -->
                        <input type="text" class="form-control"  name="adminUsername" id="adminUsername" value="">
                    </div>

                    <div class="form-group">
                        <label for="adminPassword">Password</label>
                        <input type="password" class="form-control"  name="adminPassword" id="adminPassword" value="">
                    </div>

                    <!--unsuccesful Login -->
                    <?php /* if (session()->getFlashdata('errorMessage')): ?>
<div class="col-12">
<div class="alert alert-danger" role="alert">
<?=session()->getFlashdata('errorMessage')?>
</div>
</div>
<?php endif;*/?>

                      <!--validations to Login -->
                    <?php /* if (isset($validation)): ?>
<div class="col-12">
<div class="alert alert-danger" role="alert">

<?=$validation->listErrors()?>
</div>
</div>
<?php endif;*/?>

                    <div class="row">
                        <div class="col-1 col-sm-3 ">
                            <button type="submit" name="login" class="btn" style="background-color:#be0000; color:white;">Login</button>
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
    $users->adminLogin($_REQUEST);
}

?>

