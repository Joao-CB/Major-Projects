
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Contact Form</title>
</head>
<body>
    <h2>Contact Us</h2>
    <form action="process_contact.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="contact_name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="contact_email"><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="contact_phone"><br><br>

        <input type="hidden" name="user_id" value="1"> <!-- assuming logged-in user with id 1 -->
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php

// Get form data
$contact_name = $_POST['contact_name'];
$contact_email = $_POST['contact_email'];
$contact_phone = $_POST['contact_phone'];
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;

// Insert into database
$sql = "INSERT INTO contacts (user_id, contact_name, contact_email, contact_phone, created_at)
        VALUES (?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $contact_name, $contact_email, $contact_phone);

if ($stmt->execute()) {
    echo "New contact created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
