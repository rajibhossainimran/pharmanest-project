<?php 
include_once "../config/config.php";
session_start();

if(isset($_POST['addMbtn'])){
    // Data from the form
    $medicine_name = $_POST['medicine_name'];
    $shelf_no = $_POST['shelf_no'];
    $manufacturer = $_POST['manufacturer'];
    $medicine_type = $_POST['medicine_type'];
    $generic_name = $_POST['generic_name'];
    $medicine_supplier = $_POST['medicine_supplier'];
    $medicine_status = $_POST['medicine_status'];
    $medicine_image = $_FILES['medicine_image']['name'];
    // Uploading the image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($medicine_image);
    move_uploaded_file($_FILES["medicine_image"]["tmp_name"], $target_file);
    // Insert data
    $sql = "INSERT INTO medicines (m_name, shelf_no, manufacturer, m_type, genetic, supplier, status, medicine_image) 
            VALUES ('$medicine_name', '$shelf_no', '$manufacturer', '$medicine_type', '$generic_name', '$medicine_supplier', '$medicine_status', '$target_file')";
    if ($db->query($sql) === TRUE) {
        echo "sUCCESSFULL ADDED";
        header("Location: ../medicine_list.php");

    } else {
        echo "DOES NOT ADDED";
        header("Location: ../add_medicine.php");

    }

    $db->close();
}

?>