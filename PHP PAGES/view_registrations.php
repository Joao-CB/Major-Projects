<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['user_id'])) {
    die("You need to log in to view registrations.");
}

$stmt = $pdo->query("SELECT username FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Registered Users</h2>";
foreach ($users as $user) {
    echo htmlspecialchars($user['username']) . "<br>";
}
?>
