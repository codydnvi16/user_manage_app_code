<?php
session_start();
include "../config/db.php";

// Only allow admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Check if id is passed
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prevent admin from deleting themselves
    if ($user_id == $_SESSION['user_id']) {
        echo " You cannot delete yourself!";
        exit();
    }

    // Delete user
    $query = "DELETE FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting user";
    }
} else {
    header("Location: users.php");
    exit();
}
