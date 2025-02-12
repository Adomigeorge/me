<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "user_db");
$conn->set_charset("utf8mb4"); // Ensure proper encoding

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Raw password entered by the user

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert the user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Start a session and store user ID
        session_start();
        $_SESSION['user_id'] = $conn->insert_id; // Get the ID of the newly registered user

        // Redirect to loans.php
        header("Location: loans.html");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
