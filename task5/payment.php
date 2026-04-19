<?php
include('connect.php'); // connect to database

// Fetch all payments with student info
$sql = "SELECT p.id, s.name, p.amount, p.payment_date 
        FROM payments p 
        JOIN students s ON p.student_id = s.id
        ORDER BY p.payment_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Details</title>
</head>
<body>
    <h2>All Payment Records</h2>

    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Payment ID</th>
                <th>Student Name</th>
                <th>Amount</th>
                <th>Payment Date</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo number_format($row['amount'], 2); ?></td>
                    <td><?php echo $row['payment_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No payments found.</p>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
