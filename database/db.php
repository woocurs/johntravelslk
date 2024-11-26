<?php
// Database connection parameters
$servername = 'localhost';
$username = 'u845324049_lkwoocurjohn';
$password = 'MyTravels12#';
$dbname = 'u845324049_lktravelsjohn';       

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
