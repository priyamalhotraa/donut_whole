<?php
// insert2.php - clean version for donut2 (if you want)
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db.php";

if (!isset($_POST['username'], $_POST['password'])) {
    die("Invalid submission.");
}

$username = trim($_POST['username']);
$password_raw = $_POST['password'];
$hashed = password_hash($password_raw, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO donut2 (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed);

if ($stmt->execute()) {
    echo "Successfully inserted.";
} else {
    echo "Error: " . htmlspecialchars($conn->error);
}

$stmt->close();
$conn->close();
?>

