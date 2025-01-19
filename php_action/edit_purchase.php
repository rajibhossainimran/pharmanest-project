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
     $purchDetalsql = "UPDATE purchase_details SET supp_name='$supplier_name', purch_date='$purchase_date', discount='$discount', receive_amount='$receive_amount', due_amount='$due_amount', status='$paymentStatus' WHERE invoice='$invoice'"; 
     
     if ($db->query($purchDetalsql) === TRUE) { 
        echo "Supplier information updated successfully.<br>"; 
           } else { 
            echo "Error updating supplier information: " . $db->error . "<br>"; }

    // looping data tabel 
    $batchNos = $_POST['batchNo'];
    $medicineIds = $_POST['medicineName'];
    // $quantities = $_POST['quantity'];
    // $supplierPrices = $_POST['supplierPrice'];
    $sellPrices = $_POST['sellPrice'];
    $expiryDates = $_POST['expiryDate'];
    // $totalCosts = $_POST['totalCost'];


    if (!empty($batchNos)) {
        foreach ($batchNos as $index => $batchNo) {
            $medicineId = $medicineIds[$index];
            // $quantity = $quantities[$index];
            // $supplierPrice = $supplierPrices[$index];
            $sellPrice = $sellPrices[$index];
            $expiryDate = $expiryDates[$index];
            // $totalCost = $totalCosts[$index];


            // update purchase quantity table 
            $purchaseSqlQuantity = " UPDATE purchase_quantity SET sell_price = '$sellPrice', expire_date = '$expiryDate' , batch_no = '$batchNo' , medicine_id = '$medicineId' WHERE medicine_id = '$medicineId'";
            $db->query($purchaseSqlQuantity);

            // Update medicine stock 
            $mediStocksql = "UPDATE medicine_stock SET batch_no='$batchNo',medicine_id='$medicineId', sell_price='$sellPrice', expire_date='$expiryDate'  WHERE medicine_id = '$medicineId'";

            if ($db->query($mediStocksql) === TRUE) {
                $_SESSION['success'] = "purchase update successfully";
                } else { 
                    $_SESSION['error'] = "Failed to update purchase: " . mysqli_error($db); }

        }
  
    } else {
        echo "No medicine details provided.<br>";
    }

//     if($db->query($sql) == TRUE) {
//         header("Location: ../add_supplier_list.php");	
//    } else {
//         echo "edit cannot work";
//    }
header('location: ../purchase_list.php');
   $db->close();
}



?>