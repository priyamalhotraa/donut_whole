<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donut";

// Create connection (mysqli)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_errno) {
    // In production don't show detailed errors - for dev it's okay
    die("Connection failed: " . $conn->connect_error);
}

// set charset
$conn->set_charset("utf8mb4");
?>
