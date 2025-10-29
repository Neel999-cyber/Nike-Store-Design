<?php
$host = "localhost";
$username = "root"; // Change if different
$password = "";     // Change if different
$database = "ecommerce_nike"; // Use your actual DB name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
