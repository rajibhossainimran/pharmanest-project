<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>
<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>

<?php
// Current date
$current_date = date('Y-m-d');

// Query to select expired medicines
$sql_select = "SELECT * FROM medicine_stock WHERE expire_date < ?";
$stmt_select = $db->prepare($sql_select);
$stmt_select->bind_param("s", $current_date);
$stmt_select->execute();
$result = $stmt_select->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Insert into expired_medicines
        $sql_insert = "INSERT INTO expired_medicines (batch_no, medicine_id, quantity, supp_price, sell_price, expire_date, purchase_date, moved_at)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $db->prepare($sql_insert);
        $moved_at = date('Y-m-d H:i:s');
        $stmt_insert->bind_param(
            "siiddsss",
            $row['batch_no'],
            $row['medicine_id'],
            $row['quantity'],
            $row['supp_price'],
            $row['sell_price'],
            $row['expire_date'],
            $row['purchase_date'],
            $moved_at
        );
        $stmt_insert->execute();

        // Delete from medicine_stock
        $sql_delete = "DELETE FROM medicine_stock WHERE id = ?";
        $stmt_delete = $db->prepare($sql_delete);
        $stmt_delete->bind_param("i", $row['medicine_id']);
        $stmt_delete->execute();
    }

    echo "Expired medicines moved successfully.";
} else {
    echo "No expired medicines found.";
}

// Close statements (don't close the connection yet)
$stmt_select->close();
?>

<main class="app-main">
    <div class="container mt-2 mb-5 py-5">
        <div class="d-flex justify-content-between">
            <h2 class="">Expire Medicine List</h2>
            <div>
               
            </div>
        </div>
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Medicine Name</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Purchase Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $purchase_list = $db->query("SELECT * FROM expired_medicines");
                if ($purchase_list->num_rows > 0) {
                    $counter = 1;
                    while (list($id, $batchNo, $medicine_id, $quantity, $supp_price, $sell_price, $expire_date, $purchase_invoice) = $purchase_list->fetch_row()) {
                        // Get supplier name from medicines table
                        $sql = "SELECT * FROM medicines WHERE id = $medicine_id";
                        $rowMedicine = $db->query($sql);
                        $getMedicine = $rowMedicine->fetch_assoc();
                        $medicine_name = $getMedicine['m_name'];
                        $company = $getMedicine['manufacturer'];

                        echo "<tr>
                                <td>$counter</td>
                                <td>$medicine_name</td>
                                <td>$company</td>
                                <td>$sell_price</td>
                                <td>$supp_price</td>
                                <td>$quantity</td>
                                <td>
                                    <a href='view_stock_details.php?id=$id' class='btn btn-info btn-sm text-white me-2' data-bs-toggle='tooltip' title='View'>
                                        <i class='bi bi-eye'></i>
                                    </a>
                                </td>
                              </tr>";
                        $counter++;
                    }
                } else {
                    echo "
                    <p class='h1 text-center text-muted bg-light py-3 rounded border'>
                        <i class='bi bi-info-circle me-2 h1'></i> No Expire Medicine available at the moment.
                    </p>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include("./pages/common_pages/footer.php"); ?>

<?php
// Close database connection at the very end
$db->close();
?>
