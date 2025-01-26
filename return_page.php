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
        <div class="row g-4">
            <!-- Return From Customer -->
            <div class="col-md-6">
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

            <!-- Return To Manufacturer -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Return To Supplier</h5>
                        <form>
                            <div class="mb-3">
                                <label for="purchaseId" class="form-label ms-5 ps-5">Purchase invoice <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="purchaseId" placeholder="Purchase Id" required>
                            </div>
                            <button type="submit" class="btn btn-success">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Main Part End -->

<!-- Footer Part Start -->
<?php include("./pages/common_pages/footer.php"); ?>
