<?php
include 'connect.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM orders WHERE order_id=$id");
$row = $result->fetch_assoc();
?>

<form method="POST">
    Quantity:
    <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>">
    <br><br>
    <button name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
    $qty = $_POST['quantity'];

    $conn->query("UPDATE orders SET quantity=$qty WHERE order_id=$id");

    header("Location: orders_dashboard.php");
}
?>
