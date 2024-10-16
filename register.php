<?php
session_start();
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the insert query
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    
    try {
        $stmt->execute([$username, $hashedPassword]);
        echo "User registered successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
