<?php
class DBConnection {
    private $conn;

    public function __construct() {
        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "braceletstore";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        $products = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    public function insertProduct($name, $description, $price, $image_url, $stock_quantity, $category) {
        $sql = "INSERT INTO products (name, description, price, image_url, stock_quantity, category)
                VALUES ('$name', '$description', '$price', '$image_url', '$stock_quantity', '$category')";
        return $this->conn->query($sql);
    }

    public function deleteProduct($productId) {
        $sql = "DELETE FROM products WHERE id = '$productId'";
        return $this->conn->query($sql);
    }

    public function updateProduct($productId, $name, $description, $price, $image_url, $stock_quantity, $category) {
        // Prepare SQL statement to update the product
        $sql = "UPDATE products SET 
                name = '$name', 
                description = '$description', 
                price = '$price', 
                image_url = '$image_url', 
                stock_quantity = '$stock_quantity', 
                category = '$category' 
                WHERE id = '$productId'";

        // Execute the update query
        return $this->conn->query($sql);
    }
}
?>
