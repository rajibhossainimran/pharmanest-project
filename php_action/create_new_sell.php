<?php
include_once "../config/config.php";
session_start();

if (isset($_POST['sellBtn'])) {
    $invoice_number = $_POST['invoice_number'];

    // If invoice number is empty or not provided, generate a unique one
    if (empty($invoice_number)) {
        $invoice_number = generateUniqueInvoiceNumber();
    }

    $supplier_id = $_POST['medicine_supplier'];
    $purchase_date = $_POST['purchase_date'];
    $total_amount = $_POST['total_amount'];
    $discount = $_POST['discount'];
    $received_amount = $_POST['received_amount'];
    $due_amount = $_POST['due_amount'];
    $status = $_POST['status'];

    // Insert into sell_details table
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
    if (!$stmt) {
        $_SESSION['error'] = "Database error: " . $db->error;
        header('location: ../add_new_sell.php');
        exit();
    }

    $stmt->bind_param(
        "sssdssss", 
        $invoice_number, 
        $supplier_id, 
        $purchase_date, 
        $total_amount, 
        $discount, 
        $received_amount, 
        $due_amount, 
        $status
    );
  
    if (!$stmt->execute()) {
        $_SESSION['error'] = "Failed to create purchase: " . $stmt->error;
        header('location: ../add_new_sell.php');
        exit();
    }

    $stmt->close();

    // Handle medicines and their quantities
    $medicineIds = $_POST['medicineName'];
    $quantities = $_POST['quantity'];
    $totalCosts = $_POST['totalCost'];

    if (!empty($medicineIds)) {
        foreach ($medicineIds as $index => $medicineId) {
            $quantity = $quantities[$index];
            $totalCost = $totalCosts[$index];

            // Check and update stock
            $sql = "SELECT quantity FROM medicine_stock WHERE medicine_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("i", $medicineId);
            $stmt->execute();
            $result = $stmt->get_result();
            $currentQuantit = (int)$row['quantity'];

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentQuantity = (int)$row['quantity'];
                $newQuantity = $currentQuantity - (int)$quantity;

                // Update stock
                $updateSql = "UPDATE medicine_stock SET quantity = ? WHERE medicine_id = ?";
                $stmt = $db->prepare($updateSql);
                $stmt->bind_param("ii", $newQuantity, $medicineId);
                $stmt->execute();
            }
            $Cost_sql = "INSERT INTO total_sell (total_sell,date) VALUES('$total_amount',' $purchase_date')";
            if (mysqli_query($db,  $Cost_sql)) {
                echo "done";
            } else {
                echo "error";
            }
            // Insert into sell_quantity
            $sellQuantitySql = "
                INSERT INTO sell_quantity (medicine_id, quantity, total_cost, sell_invoice) 
                VALUES (?, ?, ?, ?)
            ";
            $stmt = $db->prepare($sellQuantitySql);
            $stmt->bind_param("iids", $medicineId, $quantity, $totalCost, $invoice_number);
            $stmt->execute();
        }

        $_SESSION['success'] = "Purchase created successfully.";
    } else {
        $_SESSION['error'] = "No medicine details provided.";
    }

    header('location: ../add_new_sell.php');
    $db->close();
}

// Function to generate a unique invoice number
function generateUniqueInvoiceNumber() {
    global $db;

    do {
        $invoiceNumber = rand(10000000, 99999999); // Generate a random 6-digit number
        $stmt = $db->prepare("SELECT EXISTS(SELECT 1 FROM sell_details WHERE invoice = ?)");
        if (!$stmt) {
            die("Database error: " . $db->error);
        }
        $stmt->bind_param("s", $invoiceNumber);
        $stmt->execute();
        $stmt->bind_result($exists);
        $stmt->fetch();
        $stmt->close();
    } while ($exists);

    return $invoiceNumber;
}
?>
