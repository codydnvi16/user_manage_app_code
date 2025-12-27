<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Welcome Admin <?php echo $_SESSION['user_name']; ?></h2>
<a href="users.php">View All Users</a>


<a href="../auth/logout.php">Logout</a>

</body>
</html>
