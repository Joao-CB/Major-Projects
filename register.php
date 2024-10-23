<?php
// Initialize message variable
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
    $sql = "INSERT INTO registrations (user_id, event_id) VALUES ('$user_id', '$event_id')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    
</head>
<body>
    <h1>Event Registration</h1>
    <nav>
        <a href="add_student.php">Add Student</a> |
        <a href="view_students.php">View Students</a> |
        <a href="search.php">Search Students</a>
    </nav>

    <!-- Centered Form -->
    <div class="form-container">
        <div class="form-box">
            <!-- Display a success or error message -->
            <?php if (!empty($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>

            <!-- Form to register for an event -->
            <form action="register_event.php" method="POST"> <!-- Change the action to the correct file name -->
                User ID: <input type="number" name="user_id" required><br>
                Event ID: <input type="number" name="event_id" required><br>
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>
</html>
