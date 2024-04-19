<?php

    require_once 'db_connection.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // isset() function is using to check if each key exists in $_POST array before trying to access it
		$customerName = isset($_POST['custName']) ? $_POST['custName'] : '';
        $customeremail = isset($_POST['custEmail']) ? $_POST['custEmail'] : '';
		$customerphone = isset($_POST['custPhone']) ? $_POST['custPhone'] : '';
        $custUnitno = isset($_POST['custUnitno']) ? $_POST['custUnitno'] : '';
        $custStreet = isset($_POST['custStreetname']) ? $_POST['custStreetname'] : '';
        $custCity = isset($_POST['custCity']) ? $_POST['custCity'] : '';
        $custProvince = isset($_POST['custProvince']) ? $_POST['custProvince'] : '';
        $custCountry = isset($_POST['custCountry']) ? $_POST['custCountry'] : '';
        $custPincode = isset($_POST['custPincode']) ? $_POST['custPincode'] : '';
        $custCardname = isset($_POST['cardName']) ? $_POST['cardName'] : '';
        $custBank = isset($_POST['issuingBank']) ? $_POST['issuingBank'] : '';
        $custCardno = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
        $cardExpirydate = isset($_POST['expiryDate']) ? $_POST['expiryDate'] : '';
        $cardcvv = isset($_POST['cardcvv']) ? $_POST['cardcvv'] : ''; 

        $error_message = "";
		   
        if (empty(trim($customerName)) || !preg_match('/^[a-zA-Z\s]+$/', (trim($customerName)))) {
            $error_message = "* Please enter a valid Name.<br>";
        } else {
			$customerName = trim($customerName);
		}

        if (empty(trim($customeremail)) || !filter_var(trim($customeremail), FILTER_VALIDATE_EMAIL)) {
			$error_message .= "* Please enter a valid EmailID. <br>";
		} else {
			$customeremail = trim($customeremail);
		}

        if (empty(trim($customerphone)) || !preg_match('/^\d{3}-\d{3}-\d{4}$/', (trim($customerphone)))) {
            $error_message .= "* Please enter a valid Contact Number.<br>";
        } else {
			$customerphone = trim($customerphone);  
		}

        if (empty(trim($custUnitno)) || !preg_match('/^\d{1,4}$/', trim($custUnitno))) {
            $error_message .= "* Please enter a valid Unit Number.<br>";
        } else {
			$custUnitno = trim($custUnitno);
		}

        if (empty(trim($custStreet)) || !preg_match('/^[a-zA-Z\s]+$/', (trim($custStreet)))) {
            $error_message .= "* Please enter a valid Street Name.<br>";
        } else {
			$custStreet = trim($custStreet);
		}

        if (empty(trim($custCity)) || !preg_match('/^[a-zA-Z\s]+$/', (trim($custCity)))) {
            $error_message .= "* Please enter a valid City.<br>";
        } else {
			$custCity = trim($custCity);  
		}

        if (empty(trim($custProvince)) || !preg_match('/^[a-zA-Z\s]+$/', (trim($custProvince)))) {
            $error_message .= "* Please enter a valid Province.<br>";
        } else {
			$custProvince = trim($custProvince); 
		}

        if (empty(trim($custCountry)) || (strcasecmp($custCountry, "Canada") !== 0)) {
            $error_message .= "* Country should be Canada.<br>";
        } else {
			$custCountry = trim($custCountry);
		}

        if (empty(trim($custPincode)) || !preg_match('/^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/', trim($custPincode))) {
            $error_message .= "* Please enter a valid PinCode.<br>";
        } else {
			$custPincode = trim($custPincode); 
		}

        if (empty(trim($custCardname)) || !preg_match('/^[a-zA-Z\s]+$/', (trim($custCardname)))) {
            $error_message .= "* Please enter a valid Name.<br>";
        } else {
			$custCardname = trim($custCardname);
		}

        if (empty(trim($custBank)) || !preg_match('/^[a-zA-Z\s]+$/', (trim($custBank)))) {
            $error_message .= "* Please enter a valid Bank Name.<br>";
        } else {
			$custBank = trim($custBank);
		}

        if (empty(trim($custCardno)) || strlen($custCardno) != 16) {
            $error_message .= "* Card number should be 16 character long.<br>";
        } else {
			$custCardno = trim($custCardno);
		}

        $currentDate = date('Y-m-d');
        if (empty(trim($cardExpirydate)) || (strtotime($cardExpirydate) <= strtotime($currentDate))) {
            $error_message .= "* Expiry date should be greater than current date.<br>";
        } else {
			$cardExpirydate = trim($cardExpirydate);
		}

        if (empty(trim($cardcvv)) || strlen($cardcvv) < 3) {
            $error_message .= "* Please enter a valid CVV.<br>";
        } else {
			$cardcvv = trim($cardcvv);
		}

        if (strlen($error_message) <= 0) {
            $error_message = "";
            
            $_SESSION['customerName'] = $customerName;
            $_SESSION['customeremail'] = $customeremail;
            $_SESSION['custUnitno'] = $custUnitno;
            $_SESSION['custStreet'] = $custStreet;
            $_SESSION['custCity'] = $custCity;
            $_SESSION['custProvince'] = $custProvince;
            $_SESSION['custCountry'] = $custCountry;
            $_SESSION['custPincode'] = $custPincode;  

            header('Location: thankyou.php');       
            exit();  
        } 
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="styles.css" />
        <title>Pandora website</title>
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
        
        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        /* Container styling */
        .checkout-container {
            max-width: 100%;
            margin: 20px auto;
            padding: 50px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Section styling */
        .personal-details,
        .card-details {
            margin-bottom: 20px;
        }

        /* Header styling */
        h2 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #333333;
        }

        /* Label styling */
        .label {
            font-weight: bold;
        }

        /* Input field styling */
        .textContent {
            width: calc(100% - 10px);
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Required field styling */
        .span-required::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }

        /* Button styling */
        .buttonClick {
            text-align: center;
        }

        #submit {
            padding: 12px 24px;
            font-size: 18px;
            margin-right:200px;
            background-color: #999999;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #submit:hover {
            background-color: #999999;
        }

        /* Error message styling */
        .order-error {
            text-align: center;
            color: red;
            margin-top: 10px;
        }

</style>
    </head>
    <body class="contentbody">
    <?php include_once 'header.php'; ?>
        <main class="checkout-container"> 
        <div class="container mt-5">
        <?php
        // Calculate total price
        $totalPrice = 0;
        if (isset($_SESSION['cart_products']) && !empty($_SESSION['cart_products'])) {
            foreach ($_SESSION['cart_products'] as $productId => $productData) {
                $productPrice = $productData['price'];
                $quantity = $productData['quantity'];
                $totalPrice += $productPrice * $quantity;
            }
        }
        ?>
        <h2>Checkout</h2>
        
        <div class="row mt-4">
            <!-- Display product details -->
            <div class="col-md-12">
                <h4>----Product Details---</h4>
                <?php
                if (isset($_SESSION['cart_products']) && !empty($_SESSION['cart_products'])) {
                    foreach ($_SESSION['cart_products'] as $productId => $productData) {
                        $productName = $productData['name'];
                        $productPrice = $productData['price'];
                        $quantity = $productData['quantity'];
                        ?>
                        <p><strong><?php echo $productName; ?></strong> - Price: $<?php echo $productPrice; ?>, Quantity: <?php echo $quantity; ?></p>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <!-- Display total price -->
        <div class="mt-3 text-center">
            <h5>Total Price: $<?php echo number_format($totalPrice, 2); ?></h5>
        </div>
            <form action="" method="POST" name="order_form" id="order_form">          
                <section class="personal-details">
                    <div class="personal-section">
                        <h2>Contact Information</h2>
                        <div class="divContents">
                            <label for="custName" class="label">Customer Name:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="custName" name="custName" class="textContent" />
                            <span>*</span>
                        </div><br />                    
                        <div class="divContents">
                            <label for="custEmail" class="label">Email ID:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="custEmail" name="custEmail" class="textContent" />
                            <span>*</span>
                        </div><br />           
                        <div class="divContents">
                            <label for="custPhone" class="label">Contact No.:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="custPhone" name="custPhone" class="textContent" />
                            <span>*</span>
                        </div><br />            
                        <div class="divContents">
                            <label for="custUnitno" class="label">Unit No#.:</label>&nbsp;&nbsp;&nbsp;
                            <input type="number" id="custUnitno" name="custUnitno" class="textContent" />
                            <span>*</span>
                        </div><br />           
                        <div class="divContents">
                            <label for="custStreetname" class="label">Street Name:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="custStreetname" name="custStreetname" class="textContent" />
                            <span>*</span>
                        </div><br />
                        <div class="divContents"> 
                            <label for="custCity" class="label">City:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="custCity" name="custCity" class="textContent" />
                            <span>*</span>
                        </div><br />
                        <div class="divContents">
                            <label for="custProvince" class="label">Province:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="custProvince" name="custProvince" class="textContent" />
                            <span>*</span>
                        </div><br />
                        <div class="divContents">
                            <label for="custCountry" class="label">Country:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="custCountry" name="custCountry" class="textContent" />
                            <span>*</span>
                        </div><br />
                        <div class="divContents">
                            <label for="custPincode" class="label">Pincode:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="custPincode" name="custPincode" class="textContent" />
                            <span>*</span>
                        </div><br />            
                    </div>
                </section>
                <section class="card-details">
                    <div class="card-section">
                        <h2>Cardholder Information</h2>
                        <!-- mastercard visa american express -->
                        <div class="divContents">
                            <label for="cardName" class="label">Name on Card:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="cardName" name="cardName" class="textContent" />
                            <span>*</span>
                        </div><br />                    
                        <div class="divContents">
                            <label for="issuingBank" class="label">Issuing Bank:</label>&nbsp;&nbsp;&nbsp;
                            <input type="text" id="issuingBank" name="issuingBank" class="textContent" />
                            <span>*</span>
                        </div><br />           
                        <div class="divContents">
                            <label for="cardNumber" class="label">Card Number:</label>&nbsp;&nbsp;&nbsp;
                            <input type="number" id="cardNumber" name="cardNumber" class="textContent" />
                            <span>*</span>
                        </div><br />            
                        <div class="divContents">
                            <label for="expiryDate" class="label">Expiry Date:</label>&nbsp;&nbsp;&nbsp;
                            <input type="date" id="expiryDate" name="expiryDate" class="textContent" />
                            <span>*</span>
                        </div><br />           
                        <div class="divContents">
                            <label for="cardcvv" class="label">CVV:</label>&nbsp;&nbsp;&nbsp;
                            <input type="number" id="cardcvv" name="cardcvv" class="textContent" />
                            <span>*</span>
                        </div><br />
                    </div> 
                    <br /> 
                    <div class="buttonClick" style="margin-left: 200px;">
                        <input type="submit" name="submit" id="submit" value="PROCEED TO PAY" />
                    </div>
                    
                    <div class="order-error">
                        <h5><?php if(isset($error_message)) echo $error_message; ?></h5>
                    </div><br/>
                </section>
            </form>
        </main>
        <br />
        <?php include_once 'footer.php'; ?>
    </body>
</html>
