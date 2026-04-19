<?php
include 'connect.php';

// Get customers and order count
$sql = "SELECT c.name, COUNT(o.order_id) AS total_orders
        FROM customers c
        LEFT JOIN orders o ON c.customer_id = o.customer_id
        GROUP BY c.customer_id";

$result = $conn->query($sql);

$names = [];
$orders = [];

while ($row = $result->fetch_assoc()) {
    $names[] = $row['name'];
    $orders[] = $row['total_orders'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial; text-align: center; }
        canvas { max-width: 600px; margin: 20px auto; }
    </style>
</head>
<body>

<h2>📊 Dashboard Charts</h2>

<!-- Bar Chart -->
<h3>Orders per Customer (Bar Chart)</h3>
<canvas id="barChart"></canvas>

<!-- Pie Chart -->
<h3>Order Distribution (Pie Chart)</h3>
<canvas id="pieChart"></canvas>

<script>
const labels = <?php echo json_encode($names); ?>;
const data = <?php echo json_encode($orders); ?>;

// BAR CHART
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Orders',
            data: data,
        }]
    }
});

// PIE CHART
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: data,
        }]
    }
});
</script>

</body>
</html>
