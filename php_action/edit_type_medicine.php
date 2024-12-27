<?php
include_once "../config/config.php";
session_start();

$id = $_GET['update'];
// updatin category method added 
if(isset($_POST['update'])){
    $type = $_POST['type'];
    $status = $_POST['typeStatus'];

    $sql = "UPDATE medicine_type SET type_name = '$type', type_status = '$status' WHERE id = $id";

    if($db->query($sql) == TRUE) {
        header("Location: ../type_medicine.php");	
   } else {
        echo "edit cannot work";
   }
    
   $db->close();
}



?>