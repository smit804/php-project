<?php
session_start(); // Start or resume the session

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];
    $quantity = $_POST['quantity'];

    $product = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'image' => $productImage,
        'quantity' => $quantity
    ];

    if (!isset($_SESSION['cart_products'])) {
        $_SESSION['cart_products'] = [];
    }

    $_SESSION['cart_products'][] = $product;

    // Redirect back to the product details page with a success message
    header('Location: product_details.php?id=' . $productId . '&added_to_cart=1');
    exit;
} else {
    // If the form was not submitted correctly, redirect to the home page or an error page
    header('Location: index.php');
    exit;
}
