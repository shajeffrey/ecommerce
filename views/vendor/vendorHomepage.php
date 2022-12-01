<?php
session_start();
include 'templates/vHomeHeader.php';
?>

<h1>WELCOME TO VENDOR HOMEPAGE</h1>

<?php
if (isset($_SESSION['loginVendor'])) {
    echo $_SESSION['loginVendor'];
    unset($_SESSION['loginVendor']);
}
?>

<?php
include 'templates/footer.php';
?>

