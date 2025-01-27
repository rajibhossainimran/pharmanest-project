<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>
<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>

<?php

// Initialize variables for start and end dates
$start_date = $end_date = '';
$sell_details = [];
$total_amount_sum = 0; // Initialize variable to store the total amount

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Validate the input dates
    if (!empty($start_date) && !empty($end_date)) {
        // Query to fetch records between start_date and end_date
        $sql = "SELECT * FROM sell_details WHERE sell_date BETWEEN ? AND ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();

        // Store the results in an array
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sell_details[] = $row;
                $total_amount_sum += $row['total_amount']; // Add the total_amount to the sum
            }
        } else {
            $message = "No sales found for the selected date range.";
        }
    } else {
        $message = "Please select both start and end dates.";
    }
}
?>

<main class="app-main">
<div class="container mt-5">
        <h2 class="text-center">Get Sales Details by Date Range</h2>
        
        <!-- Form to select date range -->
        <form method="POST" class="mt-4">
            <div class="row mb-3">
                <div class="col-md-5">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?= htmlspecialchars($start_date) ?>" required>
                </div>
                <div class="col-md-5">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?= htmlspecialchars($end_date) ?>" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Get Sales</button>
                </div>
            </div>
        </form>

        <!-- Display message if no sales found -->
        <?php if (isset($message)): ?>
            <div class="alert alert-info text-center"><?= $message ?></div>
        <?php endif; ?>

        <!-- Display sales details -->
        <?php if (!empty($sell_details)): ?>
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-primary">
                    <tr>
                        <th>SL</th>
                        <th>Invoice</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Sell Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sell_details as $index => $sell): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($sell['invoice']) ?></td>
                            <td><?= htmlspecialchars($sell['customer_name']) ?></td>
                            <td><?= number_format($sell['total_amount'], 2) ?></td>
                            <td><?= htmlspecialchars($sell['sell_date']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <!-- Add footer row for total amount -->
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total  Amount:</td>
                        <td class="fw-bold"><?= number_format($total_amount_sum, 2) ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </div>

</main>
<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>
