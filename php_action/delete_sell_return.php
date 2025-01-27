<?php
// database connection 
include_once "../config/config.php";


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    session_start();

    $purchDetailSql = "SELECT * FROM return_invoice_details WHERE id = $id";
            $rowPurch = $db->query($purchDetailSql);
            $getPurch = $rowPurch->fetch_assoc();
            $invoice = $getPurch['invoice'];



    $purchaseQTNsql = "DELETE FROM return_invoice_quantity WHERE sell_invoice =$invoice";

    $db->query($purchaseQTNsql);

    $sql = "DELETE FROM return_invoice_details WHERE id=?";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirect with success message
            $_SESSION['purchaseSuccess'] = "Record DELETE successfully";
            header("Location:../return_invoice_list.php");
        } else {
            // Redirect with error message
            $_SESSION['purchaseError'] = "Failed to DELETE Record" . mysqli_error($db);
            header("Location:../return_invoice_list.php");
        }
        $stmt->close();
    } else {
        header("Location:../return_invoice_list.php");
    }
    $conn->close();
} else {
    header("Location:../return_invoice_list.php");


}

exit;
?>
