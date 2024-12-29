<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>

<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>

<div class="container mt-5">
    <h2>Add Medicine</h2>
    <form action="process_add_medicine.php" method="POST">
        <div class="form-group">
            <label for="medicine_name">Medicine Name</label>
            <input type="text" class="form-control" id="medicine_name" name="medicine_name" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" class="form-control" id="company" name="company" required>
        </div>
        <div class="form-group">
            <label for="supplier">Supplier</label>
            <input type="text" class="form-control" id="supplier" name="supplier" required>
        </div>
        <div class="form-group">
            <label for="generic_name">Generic Name</label>
            <input type="text" class="form-control" id="generic_name" name="generic_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Medicine</button>
    </form>
</div>

<?php include("./pages/common_pages/footer.php"); ?>