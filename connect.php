<?php
$servername = "localhost";  // or 127.0.0.1
$username = "root";         // your MySQL username
$password = "";             // your MySQL password
$dbname = "major_project_database";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
