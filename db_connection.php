<?php
// Set up the database connection variables
$host = 'localhost';       // Database server
$username = 'root';        // Database username
$password = '';            // Database password
$dbname = 'user_db';        // Name of your database

// Create the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for any connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
