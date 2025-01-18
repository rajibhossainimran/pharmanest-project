
<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>
<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php");?>


<?php

$id = intval($_GET['id']); 

$purchaseDetailSql = "SELECT * FROM purchase_details WHERE id = $id";

$result = $db->query($purchaseDetailSql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $invoice = $row['invoice'];
    $supp_id= $row['supp_name'];
    $purchase_date = $row['purch_date'];
    $total_amount = $row['total_amount'];
    $discount = $row['discount'];
    $receive_amount = $row['receive_amount'];
    $due_amount = $row['due_amount'];
    $paymentStatus = $row['status'];

    
} else {
    echo "No records found for ID: $id";
}

// Close the result set
$result->close();
?>
<?php 
    // Fetch supplier details
    $supplierSql = "SELECT * FROM supplier_add WHERE id = $supp_id";
    $rowSupplier = $db->query($supplierSql);

    if ($rowSupplier->num_rows > 0) {
        $getSupplier = $rowSupplier->fetch_assoc();
        $supplier_name = $getSupplier['supplier_name'];
        $supplierCompany = $getSupplier['company'];
        $supplierMobile = $getSupplier['mobile'];
    } else {
        $supplier_name = "Not Found";
        $supplierCompany = "Not Found";
        $supplierMobile = "Not Found";
    }
?>


<main class="app-main">
    
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <img class="img-fluid w-25" src="./pages/img/Pharmanest4.png" alt="image">
        </div>
    </div>
    <div class="row">
    
       <div class="mt-5 d-flex justify-content-center">
        
       <div class="col-md-6">
            <h5 class="text-success fw-bold">BILLING FROM</h5>
            <p class="mb-1 fst-italic">Supplier Name: <?php echo htmlspecialchars($supplier_name); ?></p>
            <p class="mb-1 fst-italic">Company: <?php echo htmlspecialchars($supplierCompany); ?></p>
            <p class="mb-1 fst-italic">Mobile: <?php echo htmlspecialchars($supplierMobile); ?></p>
            <p class="mb-1 fst-italic fw-semibold">invoice : <?php echo $invoice;?></p>
        </div>
        <div class="col-md-6">
            <h5 class="text-success fw-bold">BILLING TO</h5>
            <p class="mb-1 fst-italic">Pharmanest medicine</p>
            <p class="mb-1 fst-italic">Dhanmondi 27 state</p>
            <p class="mb-1 fst-italic">pharmanest@gmail.com</p>
            <p class="mb-1 fst-italic fw-semibold">Date : <?php echo $purchase_date;?></p>
        </div>
       </div>
    </div>

    <table class="table mt-4">

        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>QTY PCS</th>
                <th>Pcs Price</th>
                <th>Total Price</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>napa (1)</td>
                <td>500 boxes, 15000 pieces</td>
                <td>900.00</td>
                <td>0.00</td>
                <td>90.00</td>
                <td>0.00</td>
                <td>45000.00</td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6">
            <h5>Summary</h5>
            <p>Sub Total: 45,000.00</p>
            <p>Grand Total: 45,000.00</p>
            <p>Paid Amount: 45,000.00</p>
        </div>
    </div>
</div>
</main>

<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>


