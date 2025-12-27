<?php
session_start();
include "../config/db.php";

// Allow only admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
</head>
<body>

<h2>All Registered Users</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Action</th>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
         <th>Role Action</th> 
    </tr>

<?php
$query = "SELECT id, name, email, role FROM users";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['role']}</td>";
    echo "<td><a href='delete_user.php?id={$row['id']}'>Delete</a></td>";
    echo "<td><a href='change_role.php?id={$row['id']}'>Change Role</a></td>";
    echo "</tr>";
}


?>

</table>

<br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
