<?php 
include_once "../config/config.php";
session_start();

if(isset($_POST['create'])){
    $unit_name = $_POST['unit'];
    $unit_status= $_POST['unitStatus'];

    $sql = "INSERT INTO unit (unit_name, unit_status) 
	VALUES ('$unit_name', '$unit_status')";

    if (mysqli_query($db, $sql)) {
        // Store the success message in session
        $_SESSION['success'] = "Unit created successfully";
    } else {
        // Store the error message in session
        $_SESSION['error'] = "Failed to create Unite";
    }

    // Redirect back to category.php
    header("Location: ../unit.php");
    exit();

}

?>