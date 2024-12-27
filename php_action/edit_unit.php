<?php
include_once "../config/config.php";
session_start();

$id = $_GET['update'];
// updatin category method added 
if(isset($_POST['update'])){
    $unit = $_POST['unit'];
    $status = $_POST['unitStatus'];

    $sql = "UPDATE unit SET unit_name = '$unit', unit_status = '$status' WHERE id = $id";

    if($db->query($sql) == TRUE) {
        header("Location: ../unit.php");	
   } else {
        echo "edit cannot work";
   }
    
   $db->close();
}



?>