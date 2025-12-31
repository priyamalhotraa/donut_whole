<?php
// login_check.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "db.php";

if (!isset($_POST['email'], $_POST['password'])) {
    die("Invalid form submission.");
}

$email = trim($_POST['email']);
$password = $_POST['password'];

// Prepare select
$stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    // login success: create session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    // redirect to menu or dashboard
    header("Location: menu.html"); // replace with menu.php if you add dynamic pages
    exit;
} else {
    // invalid
    echo "<h3>Invalid Email or Password!</h3>";
    echo "<a href='index2.html'>Try Again</a>";
}

$stmt->close();
$conn->close();
?>
