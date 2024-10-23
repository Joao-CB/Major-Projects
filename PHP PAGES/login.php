<?php
$message = '';

// Process the login form when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a connection to the MySQL database
    $conn = new mysqli('localhost', 'root', 'major_project_database', '); // Update with your DB credentials

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user input to avoid SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // SQL query to check user credentials
    $sql = "SELECT * FROM Users WHERE Username='$username' AND Password='$password'"; // Assuming you have a Users table with Username and Password columns

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, redirect to the registration page or any other page
        header("Location: register.php");
        exit();
    } else {
        $message = "Invalid username or password.";
    }

    // Close the connection
    $conn->close();
}
?>
