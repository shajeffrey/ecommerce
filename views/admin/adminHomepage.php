<?php
session_start();
include 'templates/aHomeHeader.php';
?>
<!-- margin y axis (top/bottom) -->
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Welcome <?=$_SESSION['adminName'];?></h1>
    </div>
</div>
<?php
if (isset($_SESSION['loginAdmin'])) {
    echo $_SESSION['loginAdmin'];
    unset($_SESSION['loginAdmin']);
}
?>

<?php
include 'templates/footer.php';
?>

