<?php
include('check_user.php');
require_once './config/config.php';
include("./pages/common_pages/header.php");

// Ensure no whitespace or output is present in included files
include("./pages/common_pages/navber.php");
include("./pages/common_pages/sidebar.php");


?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invoice = $_POST['invoice'];
    $invoice = htmlspecialchars(trim($invoice));
    if (!empty($invoice)) {
        echo "Invoice Number: " . $invoice;
    } else {
        echo "Invoice number is required.";
    }
} else {
    echo "Invalid Request.";
}
?>

<!-- Main Part Start -->
<main class="app-main">
    <div class="container mt-5">
        <div class="row my-5">
        <div class="col-4"></div>
         <div class="col-4">
            <a href="return_invoice_list.php" class="btn btn-success d-block my-2" role="button">
        View Sell List
        </a>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row g-4">
        <?php
        if (isset($_SESSION['success'])) {
            echo "<p id='message' style='color: yellow;font-size: 30px;background-color: lightgreen; text-align: center; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
            unset($_SESSION['success']); // Clear the message after displaying it
        }
        
        if (isset($_SESSION['error'])) {
            echo "<p id='message' style='color: red;font-size: 30px;background-color: lightred; text-align: center; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']); // Clear the message after displaying it
        }
        ?>
            <!-- Return From Customer -->
             <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Return From Customer</h5>
                        <form method="GET" action="find_return_invoice.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="invoiceNo" class="form-label ms-5 ps-5">Invoice No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="invoiceNo" name="invoice" placeholder="Invoice No" required>
                        </div>
                        <button type="submit" class="btn btn-success" name="btnInvoice">Search</button>
                    </form>

                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>


        </div>
    </div>
</main>
<!-- Main Part End -->

<!-- Footer Part Start -->
<?php include("./pages/common_pages/footer.php"); ?>
