<?php

session_start();

class register
{

    //USER REGIS FUNCTION
    public function userRegis()
    {

        ?>
             <html>
             <head>
                 <title>USER REGIS</title>
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

        include '../../conn.php';

        $uFullname = $_REQUEST['uFullname'];
        $uEmail = $_REQUEST['uEmail'];
        $uLocation = $_REQUEST['uLocation'];
        $uPhone = $_REQUEST['uPhone'];
        $uName = $_REQUEST['uName'];
        $uPass = $_REQUEST['uPass'];
        $uConfirmPass = $_REQUEST['uConfirmPass'];

        $query1 = mysqli_query($conn, "SELECT userEmail FROM user WHERE userEmail= '$uEmail'");
        $query2 = mysqli_query($conn, "SELECT uName FROM user WHERE uName= '$uName'");
        $query3 = mysqli_query($conn, "SELECT userPhone FROM user WHERE userPhone= '$uPhone'");

        $sql = "INSERT INTO user VALUES ('','$uFullname','$uName','$uPass','$uEmail','$uPhone', '$uLocation', '')";

        $validateUser = mysqli_query($conn, $query);

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

        } else if ($uPass != $uConfirmPass) {
            $_SESSION['regisUser'] = "<div >Password Not Match!</div>";
            echo '<script>window.location.href = "../../views/user/userRegister.php"</script>';

        } else if (mysqli_query($conn, $sql)) {
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

    //USER REGIS FUNCTION
    public function vendorRegis()
    {

        ?>
              <html>
              <head>
                  <title>VENDOR REGIS</title>
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

        include '../../conn.php';

        $uFullname = $_REQUEST['uFullname'];
        $uEmail = $_REQUEST['uEmail'];
        $uLocation = $_REQUEST['uLocation'];
        $uPhone = $_REQUEST['uPhone'];
        $uName = $_REQUEST['uName'];
        $uPass = $_REQUEST['uPass'];
        $uConfirmPass = $_REQUEST['uConfirmPass'];

        $query1 = mysqli_query($conn, "SELECT userEmail FROM user WHERE userEmail= '$uEmail'");
        $query2 = mysqli_query($conn, "SELECT uName FROM user WHERE uName= '$uName'");
        $query3 = mysqli_query($conn, "SELECT userPhone FROM user WHERE userPhone= '$uPhone'");

        $sql = "INSERT INTO user VALUES ('','$uFullname','$uName','$uPass','$uEmail','$uPhone', '$uLocation', '')";

        $validateUser = mysqli_query($conn, $query);

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

        } else if ($uPass != $uConfirmPass) {
            $_SESSION['regisUser'] = "<div >Password Not Match!</div>";
            echo '<script>window.location.href = "../../views/user/userRegister.php"</script>';

        } else if (mysqli_query($conn, $sql)) {
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

}
