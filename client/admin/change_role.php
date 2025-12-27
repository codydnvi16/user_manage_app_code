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

    // Prevent admin from changing their own role
    if ($user_id == $_SESSION['user_id']) {
        echo " You cannot change your own role!";
        exit();
    }

    // Get current role
    $query = "SELECT role FROM users WHERE id=$user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user['role'] == 'admin') {
        $new_role = 'user';
    } else {
        $new_role = 'admin';
    }

    // Update role
    $update = "UPDATE users SET role='$new_role' WHERE id=$user_id";
    if (mysqli_query($conn, $update)) {
        header("Location: users.php");
        exit();
    } else {
        echo " Error updating role";
    }
} else {
    header("Location: users.php");
    exit();
}
