<?php include 'templates/header.php';?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper">
            <div class="container">
                <h3>Vendor Login</h3>
                <hr>
                <?php /*if (session()->get('success')): ?>

<div class="alert alert-success" role="alert">

<?=session()->get('success')?>

</div>

<?php endif;*/?>
                <form class="" action="/vendorLogin" method="post">
                    <div class="form-group">
                        <label for="vendorUsername">Username</label>
                        <!-- setvalue CI4 helper(['form']) in Users Controller -->
                        <input type="text" class="form-control" name="vendorUsername" id="vendorUsername" value="<?php ?>">
                    </div>

                    <div class="form-group">
                        <label for="vendorPass">Password</label>
                        <input type="password" class="form-control" name="vendorPass" id="vendorPass" value="">
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
                    <?php /*if (isset($validation)): ?>
<div class="col-12">
<div class="alert alert-danger" role="alert">

<?=$validation->listErrors()?>
</div>
</div>
<?php endif;*/?>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn " style="background-color:#6A0DAD; color:white;">Login</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="vendorRegister.php" style="color:#6A0DAD;">Have not yet registered?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php';?>