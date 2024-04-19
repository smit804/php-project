<?php
ob_start();
require_once('fpdf/fpdf.php');

// Start the session
session_start();

// Extend the FPDF class to create custom header and footer
class MYPDF extends FPDF {
    public function Header() {
        $this->Image('images/logo.jpg', 80, 10, 20);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 30, 'Pandora', 0, 1, 'R');
        $this->Ln(10);
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new MYPDF();

// Set document information
$pdf->SetCreator('Group');
$pdf->SetAuthor('Helee, Hanee ,Varun ,Smit');
$pdf->SetTitle('Thank You');
$pdf->SetSubject('Thank You for Your Order');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 12);

// Add title for Product Details
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Product Details', 0, 1, 'C');
$pdf->Ln(5);

// Display product details in a table
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80, 10, 'Product Name', 1, 0, 'C');
$pdf->Cell(40, 10, 'Quantity', 1, 1, 'C');
if (isset($_SESSION['cart_products']) && !empty($_SESSION['cart_products'])) {
    foreach ($_SESSION['cart_products'] as $productId => $productData) {
        $productName = $productData['name'];
        $quantity = $productData['quantity'];
        $pdf->Cell(80, 10, $productName, 1, 0);
        $pdf->Cell(40, 10, $quantity, 1, 1);
    }
} else {
    $pdf->Cell(120, 10, 'No products found', 1, 1, 'C'); // Adjusting width here
}

// Add title for Order Details
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Order Details', 0, 1, 'C');
$pdf->Ln(5);

// Display total price
// $totalPrice = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0;
// $pdf->Cell(0, 10, 'Total Price: $' . number_format($totalPrice, 2), 0, 1);

// Display customer contact information excluding phone number
$pdf->Cell(0, 10, 'Customer Information:-', 0, 1);
$pdf->Cell(0, 10, 'Name: ' . $_SESSION['customerName'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $_SESSION['customeremail'], 0, 1);
$pdf->Cell(0, 10, 'Address: ' . $_SESSION['custUnitno'] . ', ' . $_SESSION['custStreet'] . ', ' . $_SESSION['custCity'] . ', ' . $_SESSION['custProvince'] . ', ' . $_SESSION['custCountry'] . ', ' . $_SESSION['custPincode'], 0, 1);

ob_end_clean();

// Output the PDF
$pdf->Output('thankyou.pdf', 'I');

?>
