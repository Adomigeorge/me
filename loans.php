<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "user_db");
$conn->set_charset("utf8mb4"); // Ensure proper encoding

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch loans from the database
$sql = "SELECT loan_amount, loan_description, available, repayment_period, loan_type FROM loans";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error); // Error handling for query
}

$loans = [];

// Check if there are any results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $loans[] = $row;
    }
} else {
    echo "No loans found in the database."; // For empty result set
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($loans);

// Close the database connection
$conn->close();
?>
