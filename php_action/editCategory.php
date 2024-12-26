<?php
include_once "../config/config.php";
session_start();

$id = $_GET['update'];
// updatin category method added 
if(isset($_POST['update'])){
    $category = $_POST['category'];
    $status = $_POST['categoriesStatus'];

    $sql = "UPDATE category SET category_name = '$category', category_status = '$status' WHERE id = $id";

    if($db->query($sql) == TRUE) {
        header("Location: ../category.php");	
   } else {
        echo "edit cannot work";
   }
    
   $db->close();
}



?>