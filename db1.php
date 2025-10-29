<?php
$host = "localhost";
$user = "root"; // use your database username
$pass = "";     // your password ("" for XAMPP default)
$db = "ecommerce_nike"; // make sure this matches your DB name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
