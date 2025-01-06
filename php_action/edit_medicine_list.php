<?php
include_once "../config/config.php";
session_start();

$id = $_GET['update'];
// updatin category method added 
if(isset($_POST['update'])){
    $medicine_name = $_POST['medicine_name'];
    $shelf = $_POST['shelf_no'];
    $manufacturer = $_POST['manufacturer'];
    $m_type = $_POST['medicine_type'];
    $genetic = $_POST['generic_name'];
    $supulier = $_POST['medicine_supplier'];
    $status = $_POST['medicine_status'];

    $sql = "UPDATE medicines SET m_name = '$medicine_name', shelf_no = '$shelf', manufacturer = '$manufacturer', m_type = '$m_type', genetic = '$genetic', supplier = '$supulier', status = '$status' WHERE id = $id ";

    if($db->query($sql) == TRUE) {
        header("Location: ../medicine_list.php");	
   } else {
        echo "edit cannot work";
   }
    
   $db->close();
}



?>