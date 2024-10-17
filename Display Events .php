<?php
// Connect to the database
$conn = new mysqli("localhost", "username", "password", "database");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch upcoming events
$sql = "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
</head>
<body>
    <h1>Upcoming Events</h1>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="event">
            <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" width="200">
            <h2><?php echo $row['event_name']; ?></h2>
            <p><?php echo $row['description']; ?></p>
            <p><?php echo $row['created_at']; ?></p>
            <p>Date: <?php echo $row['event_date']; ?></p>
            <p>Location: <?php echo $row['location']; ?></p>
            <a href="register.php?event_id=<?php echo $row['id']; ?>">Register</a>
        </div>
    <?php endwhile; ?>

</body>
</html>

<?php
$conn->close();
?>
