<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        width: 80%;
        margin: 0 auto;
    }

    header {
        background-color: #666;
        padding: 20px 0;
        text-align: center;
    }

    header h1 {
        color: #f2f2f2;
        margin: 0;
    }

    header a {
    text-decoration: none !important;
    }

    header a:hover {
    color: #ffffff;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        color: #f2f2f2;
        text-decoration: none;
    }

    /* Footer styles */
    footer {
        background-color: #666;
        padding: 20px 0;
        margin-top: 20px;
        color: #f2f2f2;
        text-align: center;
    }

    .footer {
        text-align: center;
        color: pink;
    }

    .content {
        padding: 20px 0;
        text-align: center;
    }

    .product-details {
        padding: 20px 0;
        text-align: center;
    }

    .product-details img {
        width: 50%;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .product-details h3 {
        margin-top: 0;
    }

    .product-details p {
        margin-bottom: 10px;
    }

    .checkout-btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: black;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .checkout-btn:hover {
        background-color: #ff69b4;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .quantity-label {
        margin-right: 10px;
    }

    .quantity-input {
        width: 50px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
    }

    .btn {
    background-color: #808080;
    color: #ffffff;
    }

    .btn:hover {
        background-color: #606060;
    }

    .btn-primary {
        background-color: #000000;
    }

    .btn-primary:hover {
        background-color: #333333;
    }

    a {
        color: #ffffff;
    }

    a:hover {
        color: #cccccc;
    }
</style>
</head>
<body>

<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo "<script>alert('Please login first to add items to the cart.'); window.location.href = 'login.php';</script>";
    exit;
}

include_once 'header.php';
include_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['empty_cart'])) {
        unset($_SESSION['cart_products']);
    }

    if (isset($_POST['remove_product'])) {
        // Retrieve product ID to remove from cart
        $productIdToRemove = $_POST['product_id'];

        if (isset($_SESSION['cart_products']) && isset($_SESSION['cart_products'][$productIdToRemove])) {
            // Remove the product from the cart
            unset($_SESSION['cart_products'][$productIdToRemove]);
        }
    }
}

?>


<div class="container mt-5">
    <h2>Your Shopping Cart</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <button type="submit" name="empty_cart" class="btn btn-danger mb-3">Empty Cart</button>
    </form>
    
    <div class="row mt-4">
        <?php
        if (isset($_SESSION['cart_products']) && !empty($_SESSION['cart_products'])) {
            $totalPrice = 0;

            foreach ($_SESSION['cart_products'] as $productId => $productData) {
                $productName = $productData['name'];
                $productPrice = $productData['price'];
                $productImage = $productData['image'];
                $quantity = $productData['quantity'];

                $subtotal = $productPrice * $quantity;

                // Add subtotal to total price
                $totalPrice += $subtotal;

                // Store total price in session variable
                $_SESSION['total_price'] = $totalPrice;

                ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/<?php echo $productImage; ?>" class="card-img-top" alt="<?php echo $productName; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $productName; ?></h5>
                            <p class="card-text">Price: $<?php echo $productPrice; ?></p>
                            <p class="card-text">Quantity: <?php echo $quantity; ?></p>
                            <p class="card-text">Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                <button type="submit" name="remove_product" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="col-12">';
            echo '<div class="alert alert-info">Your cart is empty</div>';
            echo '</div>';
        }
        ?>
    </div>

    <div class="mt-3 text-center">
        <h5>Total Price: $<?php echo isset($totalPrice) ? number_format($totalPrice, 2) : '0.00'; ?></h5>
    </div>

    <div class="mt-3 text-center">
        <a href="products.php" class="btn btn-primary">Continue Shopping</a>
    </div>

    <div class="mt-4 text-center">
        <?php if (isset($_SESSION['cart_products']) && !empty($_SESSION['cart_products'])): ?>
            <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php include_once 'footer.php'; ?>