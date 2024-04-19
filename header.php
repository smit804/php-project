<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering
ob_start();

// Start session if it hasn't already been started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pandora Website</title>
    <style>
        img.logo {
            width: 28px;
            height: 25px;
            float: left;
            margin-right: 10px;
        }
        
        nav ul li:last-child {
            float: right;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
               <img src="images/logo.jpg" alt="Pandora Logo" class="logo">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="Admin/admin_login.php">Admin Login</a></li>
                <?php
                // Check if the user is logged in, display appropriate link
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                    echo '<li><span style="color: black;">Hello, ' . $_SESSION["username"] . '</span></li>';
                } else {
                    echo '<li><a href="register.php">Register</a></li>';
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
