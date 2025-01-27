<?php
include_once "../config/config.php";
session_start();

$id = $_GET['update'];
// updatin category method added 
if(isset($_POST['update'])){
    $invoice = $_POST['invoice_number'];
    $supplier_name = $_POST['medicine_supplier'];
    $purchase_date = $_POST['purchase_date'];
    $discount = $_POST['discount'];
    $receive_amount = $_POST['received_amount'];
    $due_amount = $_POST['due_amount'];
    $paymentStatus = $_POST['status'];
  
    // echo "Supplier Name: " . $supplier_name . "<br>";
    // echo "invoice: " . $invoice . "<br>";
    // echo "Purchase Date: " . $purchase_date . "<br>"; 
    // echo "Discount: " . $discount . "<br>"; 
    // echo "Received Amount: " . $receive_amount . "<br>"; 
    // echo "Due Amount: " . $due_amount . "<br>"; 
    // echo "Payment Status: " . $paymentStatus . "<br>";

    // Update purchase details information
    $purchDetalsql = "INSERT INTO return_invoice_details (invoice,customer_name, sell_date, discount, receive_amount, due_amount, status) 
                  VALUES ('$invoice','$supplier_name', '$purchase_date', '$discount', '$receive_amount', '$due_amount', '$paymentStatus')";
                  
        if ($db->query($purchDetalsql) === TRUE) { 
            echo "Supplier information updated successfully.<br>"; 
        } else { 
            echo "Error updating supplier information: " . $db->error . "<br>"; 
        }

    // looping data tabel 
    $medicineIds = $_POST['medicineName'];
    $quantities = $_POST['quantity'];
    // $supplierPrices = $_POST['supplierPrice'];
    // $sellPrices = $_POST['sellPrice'];
    // $expiryDates = $_POST['expiryDate'];
    $totalCosts = $_POST['totalCost'];


    if (!empty($medicineIds)) {
        foreach ($medicineIds as $index => $medicineId) {
            // $medicineId = $medicineIds[$index];
            $quantity = $quantities[$index];
            // $supplierPrice = $supplierPrices[$index];
            // $sellPrice = $sellPrices[$index];
            // $expiryDate = $expiryDates[$index];
            $totalCost = $totalCosts[$index];

            $returnQtn = "INSERT INTO return_invoice_quantity (medicine_id,quantity, total_cost, sell_invoice) 
            VALUES ('$medicineId','$quantity', '$totalCost', '$invoice')";
            
                if ($db->query($returnQtn) === TRUE) { 
                    echo "Supplier information updated successfully.<br>"; 
                } else { 
                    echo "Error updating supplier information: " . $db->error . "<br>"; 
                }
            //    update medicine stock and total amount 
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
                $newQuantity = $currentQuantity + (int)$quantity;

                // Update stock
                $updateSql = "UPDATE medicine_stock SET quantity = ? WHERE medicine_id = ?";
                $stmt = $db->prepare($updateSql);
                $stmt->bind_param("ii", $newQuantity, $medicineId);
                $stmt->execute();
            }
            

        }

        // delete sell_details and sell_quantity 
            $sellQtnDelete = "DELETE FROM sell_quantity WHERE sell_invoice = '$invoice'";

            if ($db->query($sellQtnDelete) === TRUE) {
                echo "All data for invoice '$invoice' has been deleted successfully from sell_quantity.<br>";
            } else {
                echo "Error deleting data for invoice '$invoice' in sell_quantity: " . $db->error . "<br>";
            }

            // SQL query to delete rows from sell_details table with the specified invoice ID
            $sellDetilDelete = "DELETE FROM sell_details WHERE invoice = '$invoice'";

            if ($db->query($sellDetilDelete) === TRUE) {
                $_SESSION['success'] = "Return successfully";
            } else {
                $_SESSION['error'] = "Failed to Return: " . mysqli_error($db);
            }

            // update total and today sell 
            $minusAmount = $receive_amount * -1;

            // Insert the updated total_sell value
            $updateSqlSell = "INSERT INTO total_sell (total_sell, date) VALUES (?, ?)";
            $stmt = $db->prepare($updateSqlSell);
            $today = date('Y-m-d');
            $stmt->bind_param("ds", $minusAmount, $today);
            $stmt->execute();
            
            
           

  
    } else {
        echo "No medicine details provided.<br>";
    }

//     if($db->query($sql) == TRUE) {
//         header("Location: ../add_supplier_list.php");	
//    } else {
//         echo "edit cannot work";
//    }
header('location: ../return_page.php');
   $db->close();
}



?>