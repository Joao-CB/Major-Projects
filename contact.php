
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
