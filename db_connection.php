<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "braceletstore";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>
