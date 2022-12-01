<?php

session_start();

class login
{
    public $username;
    public $password;

    //ADMIN LOGIN FUNCTION
    public function adminLogin()
    {

        ?>
            <html>
            <head>
                <title>ADMIN LOGIN</title>
                <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

                <style media="screen">
                *{
                    font-family: 'Poppins', sans-serif;
                }
                </style>
            </head>
            </html>

        <?php

        $this->username = $_REQUEST['adminUsername'];
        $this->password = $_REQUEST['adminPassword'];

        include '../../conn.php';

        $query = "SELECT * FROM `admin` WHERE adminUsername='$this->username' AND adminPass='$this->password' ";

        $validateAdmin = mysqli_query($conn, $query);

        if (mysqli_num_rows($validateAdmin) == 1) {

            $_SESSION['loginAdmin'] = "<div style='color: green' class='alert alert-success text-center'>Login succesful.</div>";
            echo '<script>window.location.href = "../../views/admin/adminHomepage.php"</script>';
        } else {
            echo '
				<script>
				swal({
				title: "Sorry: Does Not Match",
				text: "Try Again, Please",
				type: "warning",
			},
				function(){
					window.location.href ="../../views/admin/adminLogin.php";
				});


				</script>
				 ';
            mysqli_error($conn);
        }
        mysqli_close($conn);
    }

    //USER LOGIN FUNCTION
    public function userLogin()
    {

        ?>
            <html>
            <head>
                <title>USER LOGIN</title>
                <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

                <style media="screen">
                *{
                    font-family: 'Poppins', sans-serif;
                }
                </style>
            </head>
            </html>

        <?php

        $this->username = $_REQUEST['custUsername'];
        $this->password = $_REQUEST['custPass'];

        include '../../conn.php';

        $query = "SELECT * FROM `user` WHERE uName='$this->username' AND uPass='$this->password' ";

        $validateUser = mysqli_query($conn, $query);

        if (mysqli_num_rows($validateUser) == 1) {

            $_SESSION['loginUser'] = "<div style='color: green' class='alert alert-success text-center'>Login succesful.</div>";
            echo '<script>window.location.href = "../../views/user/userHomepage.php"</script>';
        } else {
            echo '
				<script>
				swal({
				title: "Sorry: Does Not Match",
				text: "Try Again, Please",
				type: "warning",
			},
				function(){
					window.location.href ="../../views/user/userLogin.php";
				});


				</script>
				 ';
            mysqli_error($conn);
        }
        mysqli_close($conn);
    }

    //THIS IS VENDOR LOGIN FUCNTION
    public function vendorLogin()
    {

        ?>
            <html>
            <head>
                <title>VENDOR LOGIN</title>
                <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

                <style media="screen">
                *{
                    font-family: 'Poppins', sans-serif;
                }
                </style>
            </head>
            </html>

        <?php

        $this->username = $_REQUEST['vendorUsername'];
        $this->password = $_REQUEST['vendorPass'];

        include '../../conn.php';

        $query = "SELECT * FROM `vendor` WHERE vUsername='$this->username' AND vPassword='$this->password' ";

        $validateVendor = mysqli_query($conn, $query);

        if (mysqli_num_rows($validateVendor) == 1) {

            $_SESSION['loginVendor'] = "<div style='color: green' class='alert alert-success text-center'>Login succesful.</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorHomepage.php"</script>';
        } else {
            echo '
				<script>
				swal({
				title: "Sorry: Does Not Match",
				text: "Try Again, Please",
				type: "warning",
			},
				function(){
					window.location.href ="../../views/vendor/vendorLogin.php";
				});


				</script>
				 ';
            mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

?>