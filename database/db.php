<?php
// Database connection parameters
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'johntravels';

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
