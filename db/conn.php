<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "smart@2099";
$database = "php_assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
