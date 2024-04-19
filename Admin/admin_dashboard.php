<?php
session_start();

require_once 'db_connection_admin.php';

$dbConnection = new DBConnection();

$products = $dbConnection->getAllProducts();

// Handle form submission for inserting new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $stock_quantity = $_POST['stock_quantity'];
    $category = $_POST['category'];

    $inserted = $dbConnection->insertProduct($name, $description, $price, $image_url, $stock_quantity, $category);

    if ($inserted) {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo '<script>alert("Failed to insert product. Please try again.");</script>';
    }
}

// Handle deletion of a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $productId = $_POST['product_id'];
    $deleted = $dbConnection->deleteProduct($productId);

    if ($deleted) {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo '<script>alert("Failed to delete product. Please try again.");</script>';
    }
}

// Handle form submission for updating product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $productId = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $stock_quantity = $_POST['stock_quantity'];
    $category = $_POST['category'];

    // Update the product in the database
    $updated = $dbConnection->updateProduct($productId, $name, $description, $price, $image_url, $stock_quantity, $category);

    if ($updated) {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo '<script>alert("Failed to update product. Please try again.");</script>';
    }
}

// Handle admin logout
if (isset($_GET['logout'])) {
    session_destroy();

    header('Location: admin_login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control,
        .btn {
            border-radius: 0;
        }

        .form-control {
            width: 100%;
        }

        .btn {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn:hover {
            background-color: #495057;
            border-color: #495057;
        }

        .btn-secondary {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
        }

        .btn-secondary:hover {
            background-color: #495057 !important;
            border-color: #495057 !important;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#addProductModal" data-toggle="modal">Insert Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard.php?logout=true">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4">Product List</h2>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="../images/<?php echo $product['image_url']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <p class="card-text"><strong>Price: $<?php echo $product['price']; ?></strong></p>
                        <div class="btn-group" role="group" aria-label="Product Actions">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProductModal<?php echo $product['id']; ?>">Update</button>
                            <form method="post" class="ml-2">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="delete_product" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Product Modal -->
            <div class="modal fade" id="updateProductModal<?php echo $product['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateProductModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateProductModalLabel">Update Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" required><?php echo $product['description']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="image_url">Image URL</label>
                                    <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $product['image_url']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock_quantity">Stock Quantity</label>
                                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" id="category" name="category" value="<?php echo $product['category']; ?>" required>
                                </div>
                                <button type="submit" name="update_product" class="btn btn-primary">Update Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Insert Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Insert New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Image URL</label>
                        <input type="text" class="form-control" id="image_url" name="image_url" required>
                    </div>
                    <div class="form-group">
                        <label for="stock_quantity">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-primary">Insert Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
