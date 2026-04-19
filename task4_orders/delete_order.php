<?php
include 'connect.php';

$id = $_GET['id'];

$conn->query("DELETE FROM orders WHERE order_id=$id");

header("Location: orders_dashboard.php");
?>
