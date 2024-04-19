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
</style>

<?php
session_start();

include_once 'header.php';
include_once 'db_connection.php';


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $message = "Button was clicked!";
        echo "<script>console.log('". $message ."');</script>";


    // Retrieve form data
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];
    $quantity = $_POST['quantity'];

    // Prepare product data array
    $productData = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'image' => $productImage,
        'quantity' => $quantity
    ];

    $productName = $productData['name'];
    echo $productName;


    // Initialize or retrieve cart_products from session
    if (isset($_SESSION['cart_products'])) {
        $_SESSION['cart_products'][$productId] = $productData;

    } else {
        $_SESSION['cart_products'] = [
            $productId => $productData
        ];
    }

    echo "<script>";
echo "console.log(" . json_encode($_SESSION['cart_products']) . ");";
echo "</script>";

    // Redirect to cart page or continue shopping
    header('Location: cart.php');
    exit;
}
?>

<section class="content">
    <div class="container">
        <h2>Product Details</h2>
        <div class="product-details">
            <?php
            if (isset($_GET['id'])) {
                $productId = $_GET['id'];

                $sql = "SELECT * FROM products WHERE id = '$productId'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $imagePath = 'images/' . $row['image_url'];
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="' . $row['name'] . '">';
                    } else {
                        echo '<img src="images/default_image.jpg" alt="' . $row['name'] . '">';
                    }
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p>Price: $' . $row['price'] . '</p>';

                    // Quantity controls and add to cart form
                    echo '<div class="quantity-controls">';
                    echo '<label for="quantity" class="quantity-label">Quantity:</label>';
                    echo '<button onclick="decreaseQuantity()" type="button">-</button>';
                    echo '<input type="text" id="quantity" name="quantity" class="quantity-input" value="1">';
                    echo '<button onclick="increaseQuantity()" type="button">+</button>';
                    echo '</div>';

                    // Add to Cart form
                    echo '<form method="post" action="product_details.php?id=' . $productId . '">';
                    echo '<input type="hidden" name="product_id" value="' . $productId . '">';
                    echo '<input type="hidden" name="product_name" value="' . $row['name'] . '">';
                    echo '<input type="hidden" name="product_price" value="' . $row['price'] . '">';
                    echo '<input type="hidden" name="product_image" value="' . $row['image_url'] . '">';
                    echo '<input type="hidden" name="quantity" id="finalQuantity" value="1">';
                    echo '<button type="submit" name="add_to_cart" class="checkout-btn">Add to Cart</button>';
                    echo '</form>';
                } else {
                    echo 'Product not found.';
                }

                mysqli_close($conn);
            } else {
                echo 'Product ID not provided.';
            }
            ?>
        </div>
    </div>
</section>

<script>
    function increaseQuantity() {
        var quantityInput = document.getElementById("quantity");
        var currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        document.getElementById("finalQuantity").value = quantityInput.value;
    }

    function decreaseQuantity() {
        var quantityInput = document.getElementById("quantity");
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            document.getElementById("finalQuantity").value = quantityInput.value;
        }
    }
</script>

<?php include_once 'footer.php'; ?>
