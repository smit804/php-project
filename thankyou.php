<?php include_once 'header.php'; ?>
<?php
// Retrieve data from URL parameters
$totalPrice = isset($_GET['totalPrice']) ? $_GET['totalPrice'] : 0;
$custName = isset($_GET['custName']) ? $_GET['custName'] : '';
$custEmail = isset($_GET['custEmail']) ? $_GET['custEmail'] : '';
$custPhone = isset($_GET['custPhone']) ? $_GET['custPhone'] : '';
$custUnitno = isset($_GET['custUnitno']) ? $_GET['custUnitno'] : '';
$custStreetname = isset($_GET['custStreetname']) ? $_GET['custStreetname'] : '';
$custCity = isset($_GET['custCity']) ? $_GET['custCity'] : '';
$custProvince = isset($_GET['custProvince']) ? $_GET['custProvince'] : '';
$custCountry = isset($_GET['custCountry']) ? $_GET['custCountry'] : '';
$custPincode = isset($_GET['custPincode']) ? $_GET['custPincode'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
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
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #fff;
            color: black;
        }

        .thank-you-img {
            margin-top: 20px;
            height: 200px;
            text-align: center;
        }
</style>
<body>
    <h1>Thank You for Your Order!</h1>
    <div class="thank-you-img">
        <img src="images/thankyou.jpg" alt="Thank You Image">
    </div>
    <div class="button-container">
        <button onclick="window.location.href = 'index.php';">Go to Home Page</button>
        <button style="margin-left: 10px;" onclick="generatePDF(<?php echo $totalPrice; ?>, '<?php echo $custName; ?>', '<?php echo $custEmail; ?>', '<?php echo $custPhone; ?>', '<?php echo $custUnitno; ?>', '<?php echo $custStreetname; ?>', '<?php echo $custCity; ?>', '<?php echo $custProvince; ?>', '<?php echo $custCountry; ?>', '<?php echo $custPincode; ?>');">Generate PDF</button>
    </div>

    <script>
        function generatePDF(totalPrice, custName, custEmail, custPhone, custUnitno, custStreetname, custCity, custProvince, custCountry, custPincode) {
            // Redirect to generate_pdf.php with the necessary data
            window.location.href = 'generate_pdf.php?totalPrice=' + totalPrice +
                                    '&custName=' + custName +
                                    '&custEmail=' + custEmail +
                                    '&custPhone=' + custPhone +
                                    '&custUnitno=' + custUnitno +
                                    '&custStreetname=' + custStreetname +
                                    '&custCity=' + custCity +
                                    '&custProvince=' + custProvince +
                                    '&custCountry=' + custCountry +
                                    '&custPincode=' + custPincode;
        }
    </script>
</body>
</html>
<?php include_once 'footer.php'; ?>
