<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "user_db");

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the charset to avoid encoding issues
$conn->set_charset("utf8mb4");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = trim($_POST['password']); // Raw password entered by the user

    // Fetch the user from the database by username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_hashed_password = $row['password'];
        
        // Verify the password
        if (password_verify($password, $stored_hashed_password)) {
            // Successful login: start session
            session_start();
            $_SESSION['user_id'] = $row['id'];  // Store user ID in session
            $_SESSION['username'] = $row['username'];  // Store username in session
            

// login.php (or any PHP file handling login)
session_start();

// Assuming successful login and fetching user details from the database
$_SESSION['user_id'] = $user_id;  // Store user ID in session
$_SESSION['username'] = $username; // Store username in session
$_SESSION['email'] = $email; // Store user email in session



            // Redirect to loans page
            header("Location: loans.html");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    // Close the connection
    $conn->close();
}
?>
