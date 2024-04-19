<?php
session_start();

include_once '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = 'Username and password are required';
        header('Location: admin_login.php');
        exit;
    }

    $sql = "SELECT * FROM admin_users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin user exists
    if ($result->num_rows === 1) {
        $adminUser = $result->fetch_assoc();

        // Verify password
        if ($password == $adminUser['password']) {
            $_SESSION['admin_username'] = $adminUser['username'];
            header('Location: admin_dashboard.php');
            exit;
        } else {
            $_SESSION['login_error'] = 'Invalid username or password 12';
            header('Location: admin_login.php');
            exit;
        }
    } else {
        $_SESSION['login_error'] = 'Invalid username or password';
        header('Location: admin_login.php');
        exit;
    }
} else {
    header('Location: admin_login.php');
    exit;
}
