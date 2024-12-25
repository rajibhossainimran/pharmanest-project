<?php 
include_once "../config/config.php";
session_start();

if(isset($_POST['create'])){
    $category_name = $_POST['category'];
    $category_status = $_POST['categoriesStatus'];

    $sql = "INSERT INTO category (category_name, category_status) 
	VALUES ('$category_name', '$category_status')";

    if (mysqli_query($db, $sql)) {
        // Store the success message in session
        $_SESSION['success'] = "Category created successfully";
    } else {
        // Store the error message in session
        $_SESSION['error'] = "Failed to create category";
    }

    // Redirect back to category.php
    header("Location: ../category.php");
    exit();

}

?>