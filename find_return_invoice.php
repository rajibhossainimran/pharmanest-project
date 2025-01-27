
<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>
<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>


<?php
if (isset($_GET['invoice'])) {
    
    $invoice = $_GET['invoice'];

    $invoice = htmlspecialchars(trim($invoice));

    if (!empty($invoice)) {
        echo "Invoice Number: " . $invoice;
    } else {
        echo "Invoice number is required.";
    }
} else {
    echo "No invoice number provided.";
}
?>

<main class="app-main">
    <div class="container d-flex justify-content-center align-items-center flex-column" style="height: 50vh;">
        <h2></h2>
    <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
$purchase_status = '';
$purchase_list = $db->query("SELECT * FROM sell_details WHERE invoice='$invoice'");
if ($purchase_list->num_rows > 0) {
    $counter = 1;
    while (list($id, $invoice, $supp_name, $purchase_date, $Total_amount, $discount, $receive_amount, $due_amount, $status) = $purchase_list->fetch_row()) {

        

        $sql = "SELECT customer_name FROM customer WHERE id = ?";
if ($stmt = $db->prepare($sql)) {
    $stmt->bind_param("i", $supp_name);  // "i" for integer type
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $getSupplier = $result->fetch_assoc();
        $supplier_name = $getSupplier['customer_name'];
    } else {
        $supplier_name = 'Unknown';  // Default value if no customer found
    }
    $stmt->close();
} else {
    echo "Error preparing the SQL query.";
}

        if ($status == 0) {
            $purchase_status = "<span class='badge bg-success'>Paid</span>";
        } elseif ($status == 1) {
            $purchase_status = "<span class='badge bg-danger text-dark'>Unpaid</span>";
        } else {
            $purchase_status = "<span class='badge bg-warning text-dark'>Partially paid</span>";
        }

        echo "<tr>
              <td>$counter</td>
              <td>$invoice</td>
              <td>$purchase_date</td>
              <td>$Total_amount</td>
              <td>$purchase_status</td>
              <td>
                    <a href='view_sell_details.php?id=$id' class='btn btn-primary btn-sm text-white me-2' data-bs-toggle='tooltip' title='View'>
                    <i class='bi bi-eye'></i>
                    </a>

                    <a href='return_invoice_form.php?id=$id' class='btn btn-danger btn-sm text-white me-2' data-bs-toggle='tooltip' title='Edit'>
                    <i class='bi bi-bag-plus '> return</i>
                    </a>

                </td>
          </tr>";
        $counter++;
    }
} else {
    echo "
      <p class='text-center text-muted bg-light py-3 rounded border' style='font-weight: bold; font-size: 50px;'>
        <i class='bi bi-info-circle me-2'></i> No Sale record found.
      </p>";
}
?>

            </tbody>
        </table>
    </div>
</main>
<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>
