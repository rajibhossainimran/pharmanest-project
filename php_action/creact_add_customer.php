<?php 
include_once "../config/config.php";
session_start();

if(isset($_POST['create'])){
    $customer_name = $_POST['customer_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $identifier_name = $_POST['identifier_name'];
    $identifier_mobile = $_POST['identifier_mobile'];
    $status = $_POST['customerStatus'];


    $sql = "INSERT INTO customer (customer_name,phone,email,home_address,identifier_name,identifier_phone,status) 
	VALUES (' $customer_name','$mobile','$email','$address','$identifier_name','$identifier_mobile','$status')";

    if (mysqli_query($db, $sql)) {
        // Store the success message in session
        $_SESSION['success'] = "Category created successfully";
    } else {
        // Store the error message in session
        $_SESSION['error'] = "Failed to create category";
    }

    // Redirect back to category.php
    header("Location: ../customer_list.php");
    exit();

}

?>