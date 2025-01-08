 
<?php include('check_user.php'); ?>
<!-- database  -->
 <?php require_once './config/config.php';?>
<!-- header part  -->
 <?php  include("./pages/common_pages/header.php");?>



        <!--navber and sideber part start-->
 <?php include("./pages/common_pages/navber.php");?>
 <?php include("./pages/common_pages/sidebar.php");?>
<?php 
$message_delete = isset($_GET['message_delete']) ? $_GET['message_delete'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;


?>
        
 

<main  class="app-main">

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="">Medicine Selling Information</h2>
            <div>
            <a href="add_new_sell.php" class="btn btn-success d-block my-2" role="button">
        Add New Sell
        </a>
            </div>
        </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Invoice Number</th>
                    <th scope="col">Medicine Name</th>
                    <th scope="col">Quantity Sold</th>
                    <th scope="col">Price per Unit</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Seller Name</th>                    
                    <th scope="col">Date of Sale</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Row -->
                <tr>
                    <td>1</td>
                    <td>INV123456</td>
                    <td>Paracetamol</td>
                    <td>10</td>
                    <td>5.00</td>
                    <td>50.00</td>
                    <td>John Doe</td>
                    <td>Jane Smith</td>
                    <td>2025-01-08</td>
                    <td>
                        <button class="btn btn-info btn-sm" title="View Details">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-warning btn-sm" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                <!-- Add more rows dynamically -->
            </tbody>
        </table>
    </div>
</div>



</main>
     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                