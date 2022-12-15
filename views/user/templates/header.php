<?php include '../../conn.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap 5  -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/user.css">
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
    <title>User Login</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#007dd6;font-size: 19px;">
    <div class="container">
    <a class="navbar-brand inactiveLink" href="">
        <img src="../../assets/images/ecomLogo.png" width="45" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item active"> -->
            <li class="nav-item">
            <a class="nav-link" href="../../home.php" >Mainpage <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="userLogin.php" >Login <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="userRegister.php">Register</a>
            </li>

        <!--
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li>
        -->
        </ul>

        <ul class="navbar-nav ">
            <li class="nav-item ">
                <a class="nav-link mr-auto" href="../vendor/vendorLogin.php">A Vendor? <span class="sr-only">(current)</span></a>
            </li>
        </ul>

    </div>
  </div>

</nav>
