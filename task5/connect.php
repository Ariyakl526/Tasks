<?php
// connect.php - Database connection for student registration/payment system

$servername = "localhost";          // XAMPP MySQL server
$username = "root";                 // default XAMPP username
$password = "TejaGowd@0120";                     // default XAMPP password (usually empty)
$dbname = "student_registration";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to UTF-8
$conn->set_charset("utf8");

// Uncomment the line below to check connection during debugging
// echo "Connected successfully";
?>
