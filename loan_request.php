<?php
// loan_request.php

// Assuming you have a valid DB connection
include('db_connection.php');  // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the POST request
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $loan_id = $_POST['loan_id'];
    $loan_type = $_POST['loan_type'];
    $loan_amount = $_POST['loan_amount'];
    $loan_interest = $_POST['loan_interest'];

    // Insert the data into the loan_request table
    $query = "INSERT INTO loan_request (user_id, username, email, loan_id, loan_type, loan_amount, loan_interest) 
              VALUES ('$user_id', '$username', '$email', '$loan_id', '$loan_type', '$loan_amount', '$loan_interest')";

    if (mysqli_query($conn, $query)) {
        echo "Loan request successfully submitted!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
