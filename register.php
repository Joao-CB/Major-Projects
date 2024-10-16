<?php
// Connect to the database
$conn = new mysqli("localhost", "username", "password", "database");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Insert registration
    $stmt = $conn->prepare("INSERT INTO registrations (event_id, name, email) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $event_id, $name, $email);

    if ($stmt->execute()) {
        echo "Thank you for registering!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Get event details
$event_id = $_GET['event_id'];
$sql = "SELECT * FROM events WHERE id = $event_id";
$result = $conn->query($sql);
$event = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
</head>
<body>
    <h1>Register for <?php echo $event['title']; ?></h1>

    <form action="register.php" method="POST">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <button type="submit">Register</button>
    </form>

</body>
</html>

<?php
$conn->close();
?>
