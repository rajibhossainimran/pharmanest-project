<?php
include_once "../config/config.php";
session_start();

$id = $_GET['update'];
// updatin category method added 
if(isset($_POST['update'])){
    $supplier_name = $_POST['supplier_name'];
    $company = $_POST['company'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $status = $_POST['supplierStatus'];

    $sql = "UPDATE supplier_add SET supplier_name = '$supplier_name', company = '$company', mobile = '$mobile', email = '$email', address = '$address', city = '$city', state = '$state', status = '$status' WHERE id = $id
";

    if($db->query($sql) == TRUE) {
        header("Location: ../add_supplier_list.php");	
   } else {
        echo "edit cannot work";
   }
    
   $db->close();
}



?>