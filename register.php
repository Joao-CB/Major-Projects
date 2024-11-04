<?php
$message = '';

// Process the form when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];

    // Create a connection to the MySQL database
    $conn = new mysqli('localhost', 'root', '', 'major_project_database'); // Update with your DB credentials

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user input to avoid SQL injection
    $user_id = $conn->real_escape_string($user_id);
    $event_id = $conn->real_escape_string($event_id);

    // SQL query to insert registration data
    $sql = "INSERT INTO Registrations (UserID, EventID, RegistrationDate) VALUES ('$user_id', '$event_id', NOW())";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }


}
?>

