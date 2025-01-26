
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

$purchaseDetailSql = "SELECT * FROM medicine_stock WHERE id = $id";

$result = $db->query($purchaseDetailSql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $batch = $row['batch_no'];
    $medicine_id= $row['medicine_id'];
    $quantity = $row['quantity'];
    $supp_price = $row['supp_price'];
    $sell_price = $row['sell_price'];
    $expire_date = $row['expire_date'];
    $due_amount = $row['purchase_invoice'];
 

    
} else {
    echo "No records found for ID: $id";
}

// Close the result set
$result->close();
?>
<?php 
    // Fetch supplier details
    $medicineSql = "SELECT * FROM medicines WHERE id = $medicine_id";
    $rowMedicine = $db->query($medicineSql);

    if ( $rowMedicine->num_rows > 0) {
        $getMedicine = $rowMedicine->fetch_assoc();
        $medicine_name = $getMedicine['m_name'];
        $selfNo = $getMedicine['shelf_no'];
        $manufacturer = $getMedicine['manufacturer'];
        $medi_type = $getMedicine['m_type'];
        $genetic = $getMedicine['genetic'];
        $supplier = $getMedicine['supplier'];
    } else {
        $getMedicine = "not found";
        $medicine_name = "not found";
        $selfNo = "not found";
        $manufacturer = "not found";
        $medi_type = "not found";
        $genetic = "not found";
        $supplier = "not found";
    }
?>


<main class="app-main">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Medicine Details</h2>
            <div>
                <a href="medicine_stock.php" class="btn btn-success d-block my-2" role="button">
                    Back Medicine Stock
                </a>
            </div>
        

        <?php if (!empty($row) && !empty($rowMedicine)): ?>
            <div class="card p-4">
                <h4>Batch Information</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Batch No:</th>
                        <td><?= htmlspecialchars($batch); ?></td>
                    </tr>
                    <tr>
                        <th>Quantity:</th>
                        <td><?= htmlspecialchars($quantity); ?></td>
                    </tr>
                    <tr>
                        <th>Supplier Price:</th>
                        <td><?= htmlspecialchars($supp_price); ?></td>
                    </tr>
                    <tr>
                        <th>Selling Price:</th>
                        <td><?= htmlspecialchars($sell_price); ?></td>
                    </tr>
                    <tr>
                        <th>Expire Date:</th>
                        <td><?= htmlspecialchars($expire_date); ?></td>
                    </tr>
                    <tr>
                        <th>Purchase Invoice:</th>
                        <td><?= htmlspecialchars($due_amount); ?></td>
                    </tr>
                </table>

                <h4>Medicine Information</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Medicine Name:</th>
                        <td><?= htmlspecialchars($medicine_name); ?></td>
                    </tr>
                    <tr>
                        <th>Manufacturer:</th>
                        <td><?= htmlspecialchars($manufacturer); ?></td>
                    </tr>
                    <tr>
                        <th>Type:</th>
                        <td><?= htmlspecialchars($medi_type); ?></td>
                    </tr>
                    <tr>
                        <th>Genetic:</th>
                        <td><?= htmlspecialchars($genetic); ?></td>
                    </tr>
                    <tr>
                        <th>Shelf No:</th>
                        <td><?= htmlspecialchars($selfNo); ?></td>
                    </tr>
                    <tr>
                        <th>Supplier:</th>
                        <td><?= htmlspecialchars($supplier); ?></td>
                    </tr>
                </table>
            </div>
        <?php else: ?>
            <p class="text-danger">No details available for this medicine.</p>
        <?php endif; ?>
    </div>
</main>


<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>


