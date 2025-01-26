
<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>
<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>


<?php
if (isset($_GET['invoice'])) {
    
    $invoice = $_GET['invoice'];

    $invoice = htmlspecialchars(trim($invoice));

    if (!empty($invoice)) {
        echo "Invoice Number: " . $invoice;
    } else {
        echo "Invoice number is required.";
    }
} else {
    echo "No invoice number provided.";
}
?>

<main class="app-main">

</main>
<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>
