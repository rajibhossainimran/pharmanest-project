<?php 
include_once "../config/config.php";
session_start();

if(isset($_POST['create'])){
    $supplier_name = $_POST['supplier_name'];
    $company = $_POST['company'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $status = $_POST['supplierStatus'];


    $sql = "INSERT INTO supplier_add (supplier_name, company,mobile,email,address,city,state,status) 
	VALUES (' $supplier_name', '$company','$mobile','$email','$address','$city','$state','$status')";

    if (mysqli_query($db, $sql)) {
        // Store the success message in session
        $_SESSION['success'] = "Category created successfully";
    } else {
        // Store the error message in session
        $_SESSION['error'] = "Failed to create category";
    }

    // Redirect back to category.php
    header("Location: ../add_supplier_list.php");
    exit();

}

?>