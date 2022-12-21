<?php

/* define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ecomdp');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database

$host = "localhost"; /* Host name
$user = "root"; /* User
$password = ""; /* Password
$foddb = "fodDB"; /* Database name

$conn = mysqli_connect($host, $user, $password,$foddb);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}else{
echo "Connected";
}
 */

// define('SITEURL', 'http://localhost/ecomdp/');

$sname = "localhost";

$unmae = "root";

$password = "";

$db_name = "ecomdp";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {

    echo "Connection failed!";

}
