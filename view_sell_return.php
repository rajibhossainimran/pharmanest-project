
<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>
<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php");?>


<?php

$id = intval($_GET['id']); 

$purchaseDetailSql = "SELECT * FROM return_invoice_details WHERE id = $id";

$result = $db->query($purchaseDetailSql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $invoice = $row['invoice'];
    $supp_id= $row['customer_name'];
    $purchase_date = $row['sell_date'];
    $total_amount = $row['total_amount'];
    $discount = $row['discount'];
    $receive_amount = $row['receive_amount'];
    $due_amount = $row['due_amount'];
    $paymentStatus = $row['status'];

    
} else {
    echo "No records found for ID: $id";
}

// Close the result set
$result->close();
?>
<?php 
    // Fetch supplier details
    $supplierSql = "SELECT * FROM customer WHERE id = $supp_id";
    $rowSupplier = $db->query($supplierSql);

    if ($rowSupplier->num_rows > 0) {
        $getSupplier = $rowSupplier->fetch_assoc();
        $supplier_name = $getSupplier['customer_name'];
        $supplierCompany = $getSupplier['phone'];
    } else {
        $supplier_name = "Not Found";
        $supplierCompany = "Not Found";
    }
?>


<main class="app-main">
     <div class="d-flex justify-content-around">
           <div>
            <a href="return_page.php" class="btn btn-success d-block my-2" role="button">
        Add Return
        </a>
            </div>
            <div>
            <a href="return_invoice_list.php" class="btn btn-success d-block my-2" role="button">
        View Sell List
        </a>
            </div>
    </div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <img class="img-fluid w-25" src="./pages/img/Pharmanest4.png" alt="image">
        </div>
    </div>
    <div class="row">
    
       <div class="mt-5 d-flex justify-content-center px-5">
        
       <div class="col-md-6 me-3">
            <h5 class="text-success fw-bold">BILLING FROM</h5>
            <p class="mb-1 fst-italic text-secondary">Pharmanest medicine</p>
            <p class="mb-1 fst-italic text-secondary">Dhanmondi 27 state</p>
            <p class="mb-1 fst-italic text-secondary">pharmanest@gmail.com</p>
            <p class="mb-1 fst-italic fw-semibold">invoice : <?php echo $invoice;?></p>
        </div>
        <div class="col-md-6 text-end">
            <h5 class="text-success fw-bold">BILLING TO</h5>
            <p class="mb-1 fst-italic text-secondary">Customer Name: <?php echo htmlspecialchars($supplier_name); ?></p>
            <p class="mb-1 fst-italic text-secondary">Phone: <?php echo htmlspecialchars($supplierCompany); ?></p>
            <p class="mb-1 fst-italic fw-semibold">Date : <?php echo $purchase_date;?></p>
        </div>
       </div>
    </div>

    <table class="table mt-4">

        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Quantity (pcs)</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
        <!-- displaying purchase list medicine table  -->
            <?php
                    
                    $purchase_list = $db->query("SELECT * FROM return_invoice_quantity WHERE sell_invoice = $invoice");
                    if($purchase_list->num_rows > 0){
                      $counter = 1;
                      while (list($id,$medicine_id,$quantity,$total_cost,$sell_invoice) = $purchase_list->fetch_row()) {


                        // get medicine name from supplier_ad table 
                        $mediSql = "SELECT * FROM medicines WHERE id = $medicine_id";
                        $rowMedicine = $db->query($mediSql);
                        $getMedicine = $rowMedicine->fetch_assoc();
                        $medicine_name = $getMedicine['m_name'];

                              echo "<tr>
                              <td>$counter</td>
                              <td>$medicine_name</td>
                              <td>$quantity</td>
                              <td>$total_cost</td>
                             
                              
                          </tr>";
                          $counter++;
                          
                          
                      }
                    }else{
                      echo "
                      <p class='text-center text-muted bg-light py-3 rounded border'>
                        <i class='bi bi-info-circle me-2'></i> No purchase  available at the moment.
                      </p>
                          ";
                    }
                    
                
            ?>
        </tbody>
       
    </table>

    <div class="row mt-0">
        <div class="col-md-6"></div>
        <div class="col-md-6 text-end px-5"> <table class="table table-bordered"> <tbody> <tr> <th>Sub Total</th> <td><?php echo $total_amount;?></td> </tr> <tr> <th>Discount</th> <td><?php echo $discount;?>%</td> </tr> <tr> <th>Retrun Amount</th> <td><?php echo $receive_amount;?></td> </tr> <tr> <th>Due Amount</th> <td><?php echo $due_amount;?></td> </tr> </tbody> </table> </div>
    </div>
    
</div>
</main>

<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>


