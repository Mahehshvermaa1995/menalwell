
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "menalwell";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}
?> 