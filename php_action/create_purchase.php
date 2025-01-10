<?php 


if(isset($_POST['purchaseBtn'])){
    // medicine details 
    $medicine_supplier = $_POST['medicine_supplier'];
    $invoice = $_POST['invoice'];
    $purchaseDate = $_POST['purchaseDate'];
    $totalCost = $_POST['totalPayAmount'];
    $discount = $_POST['discount'];
    $receivedAmount = $_POST['receivedAmount'];
    $dueAmount = $_POST['dueAmount'];
    $paymentStatus = $_POST['paymentStatus'];

    // medicine stock 
    $batchNo = $_POST['batchNo'];
    $medicineName = $_POST['medicineName'];
    $quantity = $_POST['quantity'];
    $supplierPrice = $_POST['supplierPrice'];
    $sellPrice = $_POST['sellPrice'];
    $expiryDate = $_POST['expiryDate'];

    $purchaseDetailsQuery = "INSERT INTO purchase_details (invoice, supp_name, purch_date, total_amount, discount, receive_amount, due_amount, status) VALUES ('$invoice', '$medicine_supplier', '$purchaseDate', '$totalCost', '$discount', '$receivedAmount', '$dueAmount', '$paymentStatus')";
    $purchaseResult = $db->query($purchaseDetailsQuery);

   
    if($purchaseResult){
        $purchaseId = $db->insert_id;
        $medicineCount = count($medicineName);
        for($i = 0; $i < $medicineCount; $i++){
            $medicineNameValue = $medicineName[$i];
            $batchNoValue = $batchNo[$i];
            $quantityValue = $quantity[$i];
            $supplierPriceValue = $supplierPrice[$i];
            $sellPriceValue = $sellPrice[$i];
            $expiryDateValue = $expiryDate[$i];
            $totalCostValue = $totalCost[$i];

            $medicineQuery = "INSERT INTO purchase_medicine (purchase_id, medicine_name, batch_no, quantity, supplier_price, sell_price, expiry_date, total_cost) VALUES ('$purchaseId', '$medicineNameValue', '$batchNoValue', '$quantityValue', '$supplierPriceValue', '$sellPriceValue', '$expiryDateValue', '$totalCostValue')";
            $medicineResult = $db->query($medicineQuery);
        }

    }

};
?>