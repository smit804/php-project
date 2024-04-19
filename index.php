<?php
// Start session
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandora Website</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .container h2{
            text-align: center;
        }

        /* Header styles */
        header {
            background-color: #666;
            padding: 20px 0;
            text-align: center;
            color: #eee;
        }

        header h1 {
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
            color: #eee;
            text-decoration: none;
        }

        /* Footer styles */
        footer {
            background-color: #666;
            padding: 20px 0;
            color: #ccc;
            text-align: center;
            margin-top: auto;
        }

        /* Home page styles */
        section.home-banner {
            position: relative;
            height: 100vh;
            background-image: url("images/home.jpg");
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .home-banner .banner-content {
            text-align: center;
        }

        .home-banner .btn {
            padding: 15px 30px;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            border: 2px solid #000;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .home-banner .btn:hover {
            background-color: #fff;
            color: #000;
        }

        .content {
            padding: 50px 0;
            flex: 1;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product-card {
        width: 30%;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        color: #000;
        text-align: left;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        }

        .product-card img {
            width: 100%;
            height: 330px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product-card h3 {
            margin-top: 0;
        }

        .weather {
            margin-top: 20px;
            text-align: center;
            color: #fff;
            margin: 0 auto;
            width: 97.5%;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .weather h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .weather div {
            margin-top: 20px;
        }

        .weather div h3 {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .weather div p {
            margin: 5px 0;
            font-size: 16px;
        }

        .weather p {
            margin: 10px 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .box {
            margin-bottom: 2px;
        }

        .box input[type="text"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .box input[type="submit"] {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #000;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include_once 'header.php'; ?>

    <section class="home-banner">
        <div class="banner-content">
            <h1>Welcome to Our E-commerce Store</h1>
            <p>Find the best products in grey and pink colors!</p>
            <a href="products.php" class="btn btn-primary">Shop Now</a>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <h2>Featured Products</h2>
            <div class="product-list">
                <div class="product-card">
                    <img src="images/gold5.jpg" alt="Classic Pandora Bracelet">
                    <h3>Classic Pandora Bracelet</h3>
                    <p>A timeless classic, this Pandora bracelet features the iconic snake chain design. Crafted from sterling silver, it's the perfect base for your Pandora charm collection.</p>
                    <p>$65.00</p>
                </div>
                <div class="product-card">
                    <img src="images/rosegold5.jpg" alt="Pandora Rose Sparkling Bow Ring">
                    <h3>Pandora Rose™ Sparkling Bow Ring</h3>
                    <p>Add a touch of elegance to your look with this stunning Pandora Rose™ ring. Adorned with sparkling cubic zirconia stones, it's sure to make a statement.</p>
                    <p>$75.00</p>
                </div>
                <div class="product-card">
                    <img src="images/silver5.jpg" alt="Pandora Moments Sparkling Snake Chain Bracelet">
                    <h3>Pandora Moments Sparkling Snake Chain Bracelet</h3>
                    <p>This beautiful Pandora Moments bracelet features a sparkling snake chain design. Crafted from sterling silver and adorned with cubic zirconia stones, it's the perfect accessory for any occasion.</p>
                    <p>$90.00</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Weather API integration -->
    <section class="weather">
        <h2>Weather Information</h2>
        <section>
            <form method="POST">
                <div class="box">
                    <h3>Check Today's Weather</h3>
                    <label for="city">Enter City Name:</label>
                    <input type="text" name="city" id="city">
                </div>
                <div class="box">
                    <input type="submit" name="submit" value="Check Weather">
                </div>
            </form>
        </section>
        <div id="weather-info">
            <?php
            if (isset($_POST['city'])) {
                $city = $_POST['city'];

                function fetchWeather($city, $apiKey) {
                    $api = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey";
                    $apiData = file_get_contents($api);
                    return json_decode($apiData, true);
                }

                // API key
                $apiKey = "7535a438fe0bf96009a11b8ee2a2b01a";

                $weatherData = fetchWeather($city, $apiKey);

                if (isset($weatherData['main']['temp'])) {
                    $temperature = round($weatherData['main']['temp'] - 273.15);
                    $description = $weatherData['weather'][0]['description'];
                    echo "<div>";
                    echo "<h3>$city</h3>";
                    echo "<p>Temperature: $temperature °C</p>";
                    echo "<p>Description: $description</p>";
                    echo "</div>";
                } else {
                    echo "<div><p>Weather data not available for $city</p></div>";
                }
            }
            ?>
        </div>
    </section>

    <?php include_once 'footer.php'; ?>

</body>
</html>
