<?php include_once 'header.php'; ?>

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
}

.product-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.product-card {
    width: 20%;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    text-align: center;
}

.product-card p {
    margin-bottom: 10px;
}

.product-card a {
    display: inline-block;
    padding: 8px 16px;
    background-color: black;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    margin-top: auto;
}

.product-card a:hover {
    background-color: #ff69b4;
}

.product-card img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
}

.product-card h3 {
    margin-top: 0;
}

.filter-section {
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.filter-section select {
    flex: 1;
    margin-right: 10px;
}

.filter-section button {
    padding: 8px 16px;
    background-color: black;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.filter-section button:hover {
    background-color: #ff69b4;
}

.price-select {
    margin-left: 20px;
}
</style>

<?php include_once 'header.php'; ?>

<section class="content">
    <div class="container">
        <h2>Products</h2>
        <div class="filter-section">
            <h3>Filter by Category:</h3>
            <select id="category-select" name="category">
                <option value="">All</option>
                <option value="gold">Gold</option>
                <option value="silver">Silver</option>
                <option value="rosegold">Rose Gold</option>
            </select>

            <h3>Filter by Price Range:</h3>
            <select id="price-select" class="price-select" name="price">
                <option value="">All</option>
                <option value="0-50">$0 - $50</option>
                <option value="50-100">$50 - $100</option>
                <option value="100-200">$100 - $200</option>
                <option value="200-more">$200 or more</option>
            </select>

            <button type="button" onclick="applyFilter()">Apply Filter</button>
        </div>

        <div class="product-list">
            <?php
            include_once 'db_connection.php';

            if ($conn) {
                $sql = "SELECT * FROM products";

                if (isset($_GET['category']) && !empty($_GET['category'])) {
                    $category = $_GET['category'];
                    $sql .= " WHERE category = '$category'";
                }

                if (isset($_GET['price']) && !empty($_GET['price'])) {
                    $price = $_GET['price'];
                    if ($price === "200-more") {
                        // Filter for products with price $200 or more
                        $sql .= " AND price >= 200";
                    } else {
                        // Extract min and max price from the selected range
                        $priceRange = explode("-", $price);
                        $minPrice = $priceRange[0];
                        $maxPrice = $priceRange[1];
                        // Add price filter to the SQL query
                        $sql .= " AND price BETWEEN $minPrice AND $maxPrice";
                    }
                }

                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Output product cards
                        echo '<div class="product-card">';
                        $imagePath = 'images/' . $row['image_url'];
                        if (file_exists($imagePath)) {
                            echo '<img src="' . $imagePath . '" alt="' . $row['name'] . '">';
                        } else {
                            echo '<img src="images/rosegold_Bracelet.jpg" alt="' . $row['name'] . '">';
                        }
                        echo '<h3>' . $row['name'] . '</h3>';
                        echo '<p>' . $row['description'] . '</p>';
                        echo '<a href="product_details.php?id=' . $row['id'] . '">View Details</a>';
                        echo '</div>';
                    }
                } else {
                    echo 'No products found.';
                }

                mysqli_close($conn);
            } else {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            ?>
        </div>
    </div>
</section>

<script>
function applyFilter() {
    var category = document.getElementById("category-select").value;
    var price = document.getElementById("price-select").value;
    // Construct the URL with category and price parameters
    var url = "products.php?";
    if (category !== "") {
        url += "category=" + category + "&";
    }
    if (price !== "") {
        url += "price=" + price;
    }
    // Redirect to the filtered page
    window.location.href = url;
}
</script>

<?php include_once 'footer.php'; ?>