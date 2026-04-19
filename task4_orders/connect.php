<?php
include '../connect.php'; // go up one folder to student_registration
session_start();

// Optional: check connection
if (!$conn) {
    die("Database connection failed");
}
?>
