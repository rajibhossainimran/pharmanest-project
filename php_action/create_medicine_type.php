<?php 
include_once "../config/config.php";
session_start();

if(isset($_POST['create'])){
    $type_name = $_POST['type'];
    $type_status = $_POST['typeStatus'];

    $sql = "INSERT INTO medicine_type (type_name, type_status) 
	VALUES ('$type_name', '$type_status')";

    if (mysqli_query($db, $sql)) {
        // Store the success message in session
        $_SESSION['success'] = "Medicine type created successfully";
    } else {
        // Store the error message in session
        $_SESSION['error'] = "Failed to create Medicine type";
    }

    // Redirect back to category.php
    header("Location: ../type_medicine.php");
    exit();

}

?>