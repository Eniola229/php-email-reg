// In dbcon.php
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "sendemail";

$con = mysqli_connect($hostname, $username, $password, $databaseName);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
