<?php
$conn = new mysqli("localhost", "root", "", "student_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>
<body>

<h2>Registered Students</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Department</th>
        <th>Phone</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['dob']}</td>
                <td>{$row['department']}</td>
                <td>{$row['phone']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

$conn->close();
?>

</table>

</body>
</html>