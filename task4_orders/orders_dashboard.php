<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Management Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
        }

        h1, h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: auto;
            background: white;
            box-shadow: 0px 0px 10px #ccc;
        }

        th {
            background: #007bff;
            color: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .nav {
            text-align: center;
            margin: 20px;
        }

        .nav a {
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px;
        }

        .card {
            padding: 20px;
            color: white;
            width: 150px;
            text-align: center;
            border-radius: 8px;
        }

        .green { background: #28a745; }
        .blue { background: #007bff; }
        .yellow { background: #ffc107; color: black; }
    </style>

</head>

<body>

<h1>📦 Order Management Dashboard</h1>

<!-- Navigation -->
<div class="nav">
    <a href="orders_dashboard.php">🏠 Home</a>
    <a href="charts.php">📊 Charts</a>
    <a href="login.html">🔐 Logout</a>
</div>

<!-- Summary Cards -->
<div class="cards">

<?php
$totalCustomers = $conn->query("SELECT COUNT(*) as total FROM customers")->fetch_assoc()['total'];
$totalOrders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];
$totalProducts = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
?>

<div class="card green">
    <h3>Customers</h3>
    <h2><?php echo $totalCustomers; ?></h2>
</div>

<div class="card blue">
    <h3>Orders</h3>
    <h2><?php echo $totalOrders; ?></h2>
</div>

<div class="card yellow">
    <h3>Products</h3>
    <h2><?php echo $totalProducts; ?></h2>
</div>

</div>

<!-- Order Table -->
<h2>Customer Order History</h2>

<table>
<tr>
    <th>Customer Name</th>
    <th>Product</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total</th>
    <th>Date</th>
    <th>Actions</th>
</tr>

<?php
$sql = "SELECT o.order_id, c.name, p.product_name, o.quantity, p.price,
        (o.quantity * p.price) AS total, o.order_date
        FROM orders o
        JOIN customers c ON o.customer_id = c.customer_id
        JOIN products p ON o.product_id = p.product_id
        ORDER BY o.order_date DESC";

$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['name']}</td>
    <td>{$row['product_name']}</td>
    <td>{$row['quantity']}</td>
    <td>{$row['price']}</td>
    <td>{$row['total']}</td>
    <td>{$row['order_date']}</td>
    <td>
        <a href='edit_order.php?id={$row['order_id']}'>Edit</a> |
        <a href='delete_order.php?id={$row['order_id']}'>Delete</a>
    </td>
    </tr>";
}
?>

</table>

<!-- Highest Value Order -->
<h2>Highest Value Order</h2>

<?php
$high_sql = "SELECT MAX(o.quantity * p.price) AS max_total
             FROM orders o
             JOIN products p ON o.product_id = p.product_id";

$high_result = $conn->query($high_sql);

if ($high_result && $row = $high_result->fetch_assoc()) {
    echo "<h3 style='text-align:center;'>₹ " . $row['max_total'] . "</h3>";
}
?>

<!-- Most Active Customer -->
<h2>Most Active Customer</h2>

<?php
$active_sql = "SELECT c.name, COUNT(o.order_id) AS total_orders
               FROM customers c
               JOIN orders o ON c.customer_id = o.customer_id
               GROUP BY c.customer_id
               ORDER BY total_orders DESC
               LIMIT 1";

$active_result = $conn->query($active_sql);

if ($active_result && $row = $active_result->fetch_assoc()) {
    echo "<h3 style='text-align:center;'>{$row['name']} ({$row['total_orders']} orders)</h3>";
}
?>

</body>
</html>
