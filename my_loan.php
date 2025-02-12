<?php
// Include the database connection file
include('db_connection.php');

// Check if the user is logged in (e.g., user_id is stored in session)
session_start();
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view your loan requests.");
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Query the database to get the user's loan requests
$query = "SELECT * FROM loan_request WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Check for database errors
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Loan Requests</title>
</head>
<body>
    <h1>Your Loan Requests</h1>

    <?php
    // Display a message if there are no loan requests
    if (mysqli_num_rows($result) == 0) {
        echo "<p>You have not requested any loans yet.</p>";
    } else {
        // Display the loan requests in a table
        echo "<table border='1'>
            <thead>
                <tr>
                    <th>Loan Type</th>
                    <th>Amount</th>
                    <th>Interest</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['loan_type']}</td>
                <td>{$row['loan_amount']}</td>
                <td>{$row['loan_interest']}</td>
                <td>{$row['status']}</td>
            </tr>";
        }

        echo "</tbody></table>";
    }
    ?>

    <a href="home.html">Go to Homepage</a>
</body>
</html>
