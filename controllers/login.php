<?php

session_start();

class login
{
    public $username;
    public $password;

    //ADMIN LOGIN FUNCTION
    public function adminLogin()
    {

        $this->username = $_REQUEST['adminUsername'];
        $this->password = $_REQUEST['adminPassword'];

        include '../../conn.php';

        $query = "SELECT * FROM `admin` WHERE adminUsername='$this->username' AND adminPass='$this->password' ";


        $validateAdmin = mysqli_query($conn, $query);

        if (mysqli_num_rows($validateAdmin) == 1) {

            $row = mysqli_fetch_assoc($validateAdmin);
            // put all admin data into session
            $_SESSION['adminID'] = $row['adminID'];
            $_SESSION['adminName'] = $row['adminName'];
            $_SESSION['adminUsername'] = $row['adminUsername'];
            $_SESSION['adminPass'] = $row['adminPass'];
            $_SESSION['adminPhone'] = $row['adminPhone'];
            $_SESSION['adminEmail'] = $row['adminEmail'];

            $_SESSION['loginAdmin'] = "<div style='color: green' class='alert alert-success text-center'>Login succesful.</div>";
            echo '<script>window.location.href = "../../views/admin/adminHomepage.php"</script>';
        } else {
            echo '
				<script>
				swal({
				title: "Sorry, Invalid Login Details!",
				text: "Try Again, Please...",
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

        $this->username = $_REQUEST['custUsername'];
        $this->password = $_REQUEST['custPass'];

        include '../../conn.php';

        $query = "SELECT * FROM `user` WHERE uName='$this->username' AND uPass='$this->password' ";

        $validateUser = mysqli_query($conn, $query);

        if (mysqli_num_rows($validateUser) == 1) {

            $row = mysqli_fetch_assoc($validateUser);
            // put all user data into session
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['userFullname'] = $row['fullName'];
            $_SESSION['userName'] = $row['uName'];
            $_SESSION['userPass'] = $row['uPass'];
            $_SESSION['userEmail'] = $row['userEmail'];
            $_SESSION['userPhone'] = $row['userPhone'];
            $_SESSION['userLocation'] = $row['userLocation'];

            $_SESSION['loginUser'] = "<div style='color: green' class='alert alert-success text-center'>Login succesful.</div>";
            echo '<script>window.location.href = "../../views/user/userHomepage.php"</script>';
        } else {
            echo '
				<script>
				swal({
				title: "Sorry, Invalid Login Details!",
				text: "Try Again, Please...",
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

        $this->username = $_REQUEST['vendorUsername'];
        $this->password = $_REQUEST['vendorPass'];

        include '../../conn.php';

        $query = "SELECT * FROM `vendor` WHERE vUsername='$this->username' AND vPassword='$this->password' ";

        $validateVendor = mysqli_query($conn, $query);

        if (mysqli_num_rows($validateVendor) == 1) {

            $row = mysqli_fetch_assoc($validateVendor);
            // put all user data into session
            $_SESSION['vendorID'] = $row['vendorID'];

            $vid = $_SESSION['vendorID'];

            $query = "SELECT * 
            FROM cart 
            JOIN userorder ON cart.orderID = userorder.orderID
            JOIN product ON cart.productID = product.productID
            WHERE product.vendorID='$vid' AND userorder.deleted='no' AND userorder.paid='yes' AND cart.completed='no' ORDER BY `cartID` DESC";
            //Execute the qUery
            $paidOrder = mysqli_query($conn, $query);
            //Count Rows to check whether we have foods or not
            $count = mysqli_num_rows($paidOrder);
            //Create Serial Number VAriable and Set Default VAlue as 1
            
            if($count>0){
                $_SESSION['paidOrder'] = "<div style='color: red' class='alert text-center'>You Have Orders to fulfill.</div>";
            }
            
            $_SESSION['vendorName'] = $row['vendorName'];
            $_SESSION['vendorEmail'] = $row['vendorEmail'];
            $_SESSION['vendorUsername'] = $row['vUsername'];
            $_SESSION['vendorPassword'] = $row['vPassword'];
            $_SESSION['vendorPhone'] = $row['vendorPhone'];
            $_SESSION['vendorLocation'] = $row['vendorLocation'];
            $_SESSION['qrUpload'] = $row['qrUpload'];
            $_SESSION['bankName'] = $row['bankName'];
            $_SESSION['bankNo'] = $row['bankNo'];

            $_SESSION['loginVendor'] = "<div style='color: green' class='alert alert-success text-center'>Login succesful.</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorHomepage.php"</script>';
        } else {
            echo '
				<script>
				swal({
				title: "Sorry, Invalid Login Details!",
				text: "Try Again, Please...",
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
