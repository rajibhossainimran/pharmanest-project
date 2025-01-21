<?php 
include_once "../config/config.php";
session_start();

if (isset($_POST['sellBtn'])) {
    // Collect POST data
    $invoice_number = $_POST['invoice_number'];
    $customer_id = $_POST['medicine_supplier'];
    $sell_date = $_POST['purchase_date'];
    $total_amount = $_POST['total_amount'];
    $discount = $_POST['discount'];
    $received_amount = $_POST['received_amount'];
    $due_amount = $_POST['due_amount'];
    $status = $_POST['status'];

    // Prepare and execute the sell_details query
    $detail_sql = "
        INSERT INTO sell_details (
            invoice, 
            customer_name, 
            sell_date, 
            total_amount, 
            discount, 
            receive_amount, 
            due_amount, 
            status
        ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $db->prepare($detail_sql);
    $stmt->bind_param(
        "sssddddd", 
        $invoice_number, 
        $customer_id, 
        $sell_date, 
        $total_amount, 
        $discount, 
        $received_amount, 
        $due_amount, 
        $status
    );

    // Execute the prepared statement
    if (!$stmt->execute()) {
        $_SESSION['error'] = "Failed to create sell details: " . $stmt->error;
        header('location: ../add_new_sell.php');
        exit();
    }

    // Data from POST for medicines
    $medicineIds = $_POST['medicineName'];
    $quantities = $_POST['quantity'];
    $totalCosts = $_POST['totalCost'];

    if (!empty($medicineIds)) {
        foreach ($medicineIds as $index => $medicineId) {
            $quantity = $quantities[$index];
            $totalCost = $totalCosts[$index];

            // Check if medicine stock exists
            $stockSql = "SELECT quantity FROM medicine_stock WHERE medicine_id = ?";
            $stockStmt = $db->prepare($stockSql);
            $stockStmt->bind_param("i", $medicineId);
            $stockStmt->execute();
            $stockResult = $stockStmt->get_result();

            if ($stockResult && $stockResult->num_rows > 0) {
                $row = $stockResult->fetch_assoc();
                $currentQuantity = (int)$row['quantity'];

                // Calculate new stock quantity
                $newQuantity = $currentQuantity - (int)$quantity;

                if ($newQuantity < 0) {
                    echo "Insufficient stock for medicine ID: $medicineId<br>";
                    continue;
                }

                // Insert into sell_quantity table
                $sellQuantitySql = "
                    INSERT INTO sell_quantity 
                    (medicine_id, quantity, total_cost, sell_invoice) 
                    VALUES (?, ?, ?, ?)
                ";
                $sellQuantityStmt = $db->prepare($sellQuantitySql);
                $sellQuantityStmt->bind_param("iids", $medicineId, $quantity, $totalCost, $invoice_number);

                if (!$sellQuantityStmt->execute()) {
                    echo "Error inserting sell quantity for medicine ID: $medicineId. " . $sellQuantityStmt->error . "<br>";
                    continue;
                }

                // Update medicine stock quantity
                $updateStockSql = "UPDATE medicine_stock SET quantity = ? WHERE medicine_id = ?";
                $updateStockStmt = $db->prepare($updateStockSql);
                $updateStockStmt->bind_param("ii", $newQuantity, $medicineId);

                if (!$updateStockStmt->execute()) {
                    echo "Error updating stock for medicine ID: $medicineId. " . $updateStockStmt->error . "<br>";
                }
            } else {
                echo "Medicine ID $medicineId not found in stock.<br>";
            }
        }

        $_SESSION['success'] = "Sell created successfully.";
    } else {
        $_SESSION['error'] = "No medicine details provided.";
    }

    // Redirect to the sell page
    header('location: ../add_new_sell.php');
    $db->close();
    exit();
}
?>
