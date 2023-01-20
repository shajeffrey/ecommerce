<!-- REGISTER CLASS -->
<?php

session_start();

class register
{

    //USER REGIS FUNCTION
    public function userRegis()
    {
        include '../../conn.php';

        $_SESSION['uFullname'] = $uFullname = $_REQUEST['uFullname'];
        $_SESSION['uEmail'] = $uEmail = $_REQUEST['uEmail'];
        $_SESSION['uLocation'] = $uLocation = $_REQUEST['uLocation'];
        $_SESSION['uPhone'] = $uPhone = $_REQUEST['uPhone'];
        $_SESSION['uName'] = $uName = $_REQUEST['uName'];
        $uPass = $_REQUEST['uPass'];
        $uConfirmPass = $_REQUEST['uConfirmPass'];

        $query1 = mysqli_query($conn, "SELECT userEmail FROM user WHERE userEmail= '$uEmail'");
        $query2 = mysqli_query($conn, "SELECT uName FROM user WHERE uName= '$uName'");
        $query3 = mysqli_query($conn, "SELECT userPhone FROM user WHERE userPhone= '$uPhone'");

        // $sql = "INSERT INTO user VALUES ('','$uFullname','$uName','$uPass','$uEmail','$uPhone', '$uLocation', '' )";
        $sql2 = "INSERT INTO `user`( `fullName`, `uName`, `uPass`, `userEmail`, `userPhone`, `userLocation`)
        VALUES ('$uFullname','$uName','$uPass', '$uEmail' ,'$uPhone' , '$uLocation')";

        if (mysqli_num_rows($query1) == 1) {
            $_SESSION['regisUser'] = "<div >Email already in Use!</div>";
            echo '<script>window.location.href = "../../views/user/userRegister.php"</script>';
        } else if (mysqli_num_rows($query2) == 1) {
            $_SESSION['regisUser'] = "<div >Username already in Use!</div>";
            echo '<script>window.location.href = "../../views/user/userRegister.php"</script>';

        } else if (mysqli_num_rows($query3) == 1) {
            $_SESSION['regisUser'] = "<div >Phone number already in Use!</div>";
            echo '<script>window.location.href = "../../views/user/userRegister.php"</script>';

        } else if (strlen($uPhone) < 10 || strlen($uPhone) > 12) {
            $_SESSION['regisUser'] = "<div >Phone Number 10-12 digits!</div>";
            echo '<script>window.location.href = "../../views/user/userRegister.php"</script>';

        } else if (strlen($uPass) < 6) {
            $_SESSION['regisUser'] = "<div >Password length at least 6</div>";
            echo '<script>window.location.href = "../../views/user/userRegister.php"</script>';

        } else if ($uPass != $uConfirmPass) {
            $_SESSION['regisUser'] = "<div >Password Not Match!</div>";
            echo '<script>window.location.href = "../../views/user/userRegister.php"</script>';

        } else if (mysqli_query($conn, $sql2)) {
            $_SESSION['regisUser'] = "<div >Try & Login!.</div>";
            echo '
			<script>
			sweetAlert({
					title: "Thank You! For Registering With Us",
					text: "Data Stored Successfully",
					type: "success",
				},

				function(){
							window.location.href ="../../views/user/userLogin.php";
				});

				</script>
				';
        } else {
            echo '
				<script>
				swal({
				title: "ERROR: 404!",
				text: "Please Contact Admin",
				type: "warning",
			},
				function(){
					window.location.href ="../../views/user/userRegister.php";
				});


				</script>
				 ';
            mysqli_error($conn);
        }
        mysqli_close($conn);
    }

    public function vendorRegis()
    {
        include '../../conn.php';

        $_SESSION['vName'] = $vName = $_REQUEST['vName'];
        $_SESSION['vEmail'] = $vEmail = $_REQUEST['vEmail'];
        $_SESSION['vPhone'] = $vPhone = $_REQUEST['vPhone'];
        $_SESSION['vLocation'] = $vLocation = $_REQUEST['vLocation'];
        $_SESSION['vBankName'] = $vBankName = $_REQUEST['vBankName'];
        $_SESSION['vBankNo'] = $vBankNo = $_REQUEST['vBankNo'];
        $_SESSION['vUsername'] = $vUsername = $_REQUEST['vUsername'];
        $vPass = $_REQUEST['vPass'];
        $vConfirmPass = $_REQUEST['vConfirmPass'];

        $query1 = mysqli_query($conn, "SELECT vendorEmail FROM vendor WHERE vendorEmail= '$vEmail'");
        $query2 = mysqli_query($conn, "SELECT vUsername FROM vendor WHERE vUsername= '$vUsername'");
        $query3 = mysqli_query($conn, "SELECT vendorPhone FROM vendor WHERE vendorPhone= '$vPhone'");
        $query4 = mysqli_query($conn, "SELECT bankNo FROM vendor WHERE bankNo= '$vBankNo'");

        $sql = "INSERT INTO vendor VALUES ('','$vName','$vEmail','$vUsername','$vPass','$vPhone', '$vLocation', '', '$vBankName' ,'$vBankNo')";
        // $sql = "INSERT INTO complaint VALUES ('','$vName','$vEmail','$vUsername','$vPass','$vPhone', '$vLocation', '', '$vBankName' ,'$vBankNo')";

        if (mysqli_num_rows($query1) == 1) {
            $_SESSION['regisVendor'] = "<div >Email already in Use!</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorRegister.php"</script>';
        } else if (mysqli_num_rows($query2) == 1) {
            $_SESSION['regisVendor'] = "<div >Username already in Use!</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorRegister.php"</script>';

        } else if (mysqli_num_rows($query3) == 1) {
            $_SESSION['regisVendor'] = "<div >Phone number already in Use!</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorRegister.php"</script>';

        } else if (mysqli_num_rows($query4) == 1) {
            $_SESSION['regisVendor'] = "<div >Bank number already in Use!</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorRegister.php"</script>';

        } else if (strlen($vPhone) < 10 || strlen($vPhone) > 12) {
            $_SESSION['regisVendor'] = "<div >Phone Number 10-12 digits!</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorRegister.php"</script>';

        } else if (strlen($vBankNo) < 9 || strlen($vBankNo) > 17) {
            $_SESSION['regisVendor'] = "<div >Bank No 9-17 digits!</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorRegister.php"</script>';

        } else if (strlen($vPass) < 6) {
            $_SESSION['regisVendor'] = "<div >Password length at least 6</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorRegister.php"</script>';

        } else if ($vPass != $vConfirmPass) {
            $_SESSION['regisVendor'] = "<div >Password Not Match!</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorRegister.php"</script>';

        } else if (mysqli_query($conn, $sql)) {
            $_SESSION['regisVendor'] = "<div >Try & Login!.</div>";
            echo '
			<script>
			sweetAlert({
					title: "Thank You! For Registering With Us",
					text: "Data Stored Successfully",
					type: "success",
				},

				function(){
							window.location.href ="../../views/vendor/vendorLogin.php";
				});

				</script>
				';
        } else {
            echo '
				<script>
				swal({
				title: "ERROR: 404!",
				text: "Please Contact Admin",
				type: "warning",
			},
				function(){
					window.location.href ="../../views/vendor/vendorRegister.php";
				});


				</script>
				 ';
            mysqli_error($conn);
        }
        mysqli_close($conn);
    }

}
