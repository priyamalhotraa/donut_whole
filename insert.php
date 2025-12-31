<?php
// insert.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";

// Basic validation: check mandatory fields exist
if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    die("Invalid form submission.");
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$number = trim($_POST['number'] ?? '');
$address = trim($_POST['address'] ?? '');
$password_raw = $_POST['password'];

// Hash password
$hashed_password = password_hash($password_raw, PASSWORD_DEFAULT);

// Use prepared statement to insert
$stmt = $conn->prepare("INSERT INTO users (name, email, number, address, password) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssss", $name, $email, $number, $address, $hashed_password);

if ($stmt->execute()) {
    // Signup success - redirect to login page
    header("Location: index2.html"); // or login.php
    exit;
} else {
    // If email duplicate, show friendly message
    if ($conn->errno === 1062) {
        echo "<h3>Email already registered. Please <a href='index2.html'>login</a> or use another email.</h3>";
    } else {
        echo "Error inserting: " . htmlspecialchars($conn->error);
    }
}

$stmt->close();
$conn->close();
?>
