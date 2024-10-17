<?php
// Connect to the database
$conn = new mysqli('localhost', 'username', 'password', 'database_name');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Redirect on successful registration
        header('Location: login.html');
        exit(); // Always call exit after a header redirection
    } else {
        // Handle registration error
        echo "Registration failed. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>
