<?php
session_start();
include 'templates/aHomeHeader.php';
?>

<h1>WELCOME TO ADMIN HOMEPAGE</h1>
<?php
if (isset($_SESSION['loginAdmin'])) {
    echo $_SESSION['loginAdmin'];
    unset($_SESSION['loginAdmin']);
}
?>

<?php
include 'templates/footer.php';
?>

