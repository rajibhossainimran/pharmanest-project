<?php 
include_once "../config/config.php";
session_start();

if (isset($_POST['purchaseBtn'])) {
    $invoice_number = $_POST['invoice_number'];
    $supplier_id = $_POST['medicine_supplier'];
    $purchase_date = $_POST['purchase_date'];
    $total_amount = $_POST['total_amount'];
    $discount = $_POST['discount'];
    $received_amount = $_POST['received_amount'];
    $due_amount = $_POST['due_amount'];
    $status = $_POST['status'];

    $detail_sql = "
    INSERT INTO purchase_details (
        invoice, 
        supp_name, 
        purch_date, 
        total_amount, 
        discount, 
        receive_amount, 
        due_amount, 
        status
    ) 
    VALUES (
        '$invoice_number', 
        '$supplier_id', 
        '$purchase_date', 
        '$total_amount', 
        '$discount', 
        '$received_amount', 
        '$due_amount', 
        '$status'
    )
";
    

    // Data from POST
    $batchNos = $_POST['batchNo'];
    $medicineIds = $_POST['medicineName'];
    $quantities = $_POST['quantity'];
    $supplierPrices = $_POST['supplierPrice'];
    $sellPrices = $_POST['sellPrice'];
    $expiryDates = $_POST['expiryDate'];
    $totalCosts = $_POST['totalCost'];

    
    if (!empty($batchNos)) {
        foreach ($batchNos as $index => $batchNo) {
            $medicineId = $medicineIds[$index];
            $quantity = $quantities[$index];
            $supplierPrice = $supplierPrices[$index];
            $sellPrice = $sellPrices[$index];
            $expiryDate = $expiryDates[$index];
            $totalCost = $totalCosts[$index];


            // check if medicine stock exists
            $sql = "SELECT quantity FROM medicine_stock WHERE medicine_id = $medicineId";
            $result = $db->query($sql);
            
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentQuantity = (int)$row['quantity'];
            
                $newQuantity = $currentQuantity + (int)$quantity;

                // purchase_qunatity data insert in table 
                $purchaseSqlQuntity = "
                    INSERT INTO purchase_quantity 
                    (medicine_id, quantity, per_price, total_cost, purchase_invoice, batch_no,sell_price,expire_date) 
                    VALUES ('$medicineId', '$quantity', '$supplierPrice', '$totalCost', '$invoice_number', '$batchNo','$sellPrice','$expiryDate')
                ";
                $db->query($purchaseSqlQuntity);

                //update query
                $updateSql = "UPDATE medicine_stock SET quantity = '$newQuantity', supp_price = '$supplierPrice', sell_price = '$sellPrice', expire_date = '$expiryDate', purchase_invoice = '$invoice_number' WHERE medicine_id = $medicineId";
            
                if ($db->query($updateSql) === TRUE) {
                    echo "Record updated successfully for batch: $batchNo<br>";
                } else {
                    echo "Error updating record: " . $db->error . "<br>";
                }
            } else {
                // Prepare and execute the SQL query
                $stmt = $db->prepare("
                    INSERT INTO medicine_stock (
                        batch_no, 
                        medicine_id, 
                        quantity, 
                        supp_price, 
                        sell_price, 
                        expire_date,
                        purchase_invoice
                    ) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->bind_param("siiddss", $batchNo, $medicineId, $quantity, $supplierPrice, $sellPrice, $expiryDate, $invoice_number);

                if ($stmt->execute()) {
                    echo "Record inserted successfully for batch: $batchNo<br>";
                } else {
                    echo "Error: " . $stmt->error . "<br>";
                }

                // purchase_qunatity data insert in table 
                $purchaseSqlQuntity = "
                    INSERT INTO purchase_quantity 
                    (medicine_id, quantity, per_price, total_cost, purchase_invoice, batch_no,sell_price,expire_date) 
                    VALUES ('$medicineId', '$quantity', '$supplierPrice', '$totalCost', '$invoice_number', '$batchNo','$sellPrice','$expiryDate')
                ";
                $db->query($purchaseSqlQuntity);
            }

        }
    // data send in purchase_details table
        if (mysqli_query($db, $detail_sql)) {
            $_SESSION['success'] = "purchase created successfully";
        } else {
            $_SESSION['error'] = "Failed to create purchase: " . mysqli_error($db);
        }

           // insert total sell 
           $sellCost_sql = "INSERT INTO total_purchase (total_cost,date) VALUES('$total_amount','$purchase_date')";
           if (mysqli_query($db,  $sellCost_sql)) {
               echo "done";
           } else {
               echo "error";
           }
    } else {
        echo "No medicine details provided.<br>";
    }

    header('location: ../add_purchase.php');
    $db->close();

    // / Execute the SQL queries

}

?>