<?php
$conn = new mysqli("localhost", "root", "", "student_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$orderBy = "";

if ($sort == "name") {
    $orderBy = "ORDER BY name ASC";
} elseif ($sort == "dob") {
    $orderBy = "ORDER BY dob ASC";
}

// Filtering
$dept = isset($_GET['department']) ? $_GET['department'] : '';
$where = "";

if (!empty($dept)) {
    $where = "WHERE department = '$dept'";
}

// Fetch students
$sql = "SELECT * FROM students $where $orderBy";
$result = $conn->query($sql);

// Count per department
$countSql = "SELECT department, COUNT(*) as total FROM students GROUP BY department";
$countResult = $conn->query($countSql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Student Dashboard</h2>

<!-- 🔹 Filter -->
<form method="GET">
    <label>Filter by Department:</label>
    <select name="department">
        <option value="">All</option>
        <option value="CSE">CSE</option>
        <option value="ECE">ECE</option>
        <option value="MECH">MECH</option>
        <option value="IT">IT</option>
    </select>

    <label>Sort By:</label>
    <select name="sort">
        <option value="">None</option>
        <option value="name">Name</option>
        <option value="dob">DOB</option>
    </select>

    <button type="submit">Apply</button>
</form>

<br>

<!-- 🔹 Table -->
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
?>
</table>

<br>

<!-- 🔹 Count per Department -->
<h3>Department-wise Count</h3>

<table border="1" cellpadding="10">
<tr>
    <th>Department</th>
    <th>Total Students</th>
</tr>

<?php
if ($countResult->num_rows > 0) {
    while($row = $countResult->fetch_assoc()) {
        echo "<tr>
            <td>{$row['department']}</td>
            <td>{$row['total']}</td>
        </tr>";
    }
}
$conn->close();
?>

</table>

</body>
</html>