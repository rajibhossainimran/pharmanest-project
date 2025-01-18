<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>
<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>

<?php
// Query to fetch data
$sql = "SELECT * FROM medicines";
$result = $db->query($sql);
?>
<main class="app-main">
    <div class="container mt-2 mb-5 py-5">
    <div class="d-flex justify-content-between">
        <h2 class="">Purchase Details</h2>
            <div>
            <a href="add_purchase.php" class="btn btn-success d-block my-2" role="button">
        Add New purchase
        </a>
            </div>
        </div>
    <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    $purchase_status='';
                    $purchase_list = $db->query("SELECT * FROM purchase_details");
                    if($purchase_list->num_rows > 0){
                      $counter = 1;
                      while (list($id,$invoice,$supp_name,$purchase_date,$Total_amount,$discount,$receive_amount,$due_amount,$status) = $purchase_list->fetch_row()) {


                        // get supplier name from supplier_ad table 
                        $sql = "SELECT supplier_name FROM supplier_add WHERE id = $supp_name";
                        $rowSupplier = $db->query($sql);
                        $getSupplier = $rowSupplier->fetch_assoc();
                        $supplier_name = $getSupplier['supplier_name'];

                        if($status == 0) {
                          // activate member
                          $purchase_status = "<span class='badge bg-success'>Paid</span>";
                        } elseif($status == 1) {
                          // deactivate member
                          $purchase_status = "<span class='badge bg-danger text-dark'>Unpaid</span>";
                        }else{
                            $purchase_status = "<span class='badge bg-warning text-dark'>Partially paid</span>";
                        }
    
                              echo "<tr>
                              <td>$counter</td>
                              <td>$invoice</td>
                              <td>$supplier_name</td>
                              <td>$purchase_date</td>
                              <td>$Total_amount</td>
                              <td>$purchase_status</td>
                              <td>
                                    <a href='view_purchase_details.php?id=$id' class='btn btn-info btn-sm text-white me-2' data-bs-toggle='tooltip' title='View'>
                                    <i class='bi bi-eye'></i>
                                    </a>

                                  <a href='#' 
                                  class='btn btn-primary btn-sm text-white me-2' 
                                  data-bs-toggle='tooltip' 
                                  title='Edit'>
                                  <i class='bi bi-pencil-square'></i>
                                  </a>
              
                                  <a href='#' class='btn btn-danger btn-sm text-white' data-bs-toggle='tooltip' 
                                  title='Delete'>
                                  <i class='bi bi-trash'></i>
                                  </a>
                              </td>
                              
                          </tr>";
                          $counter++;
                          
                          
                      }
                    }else{
                      echo "
                      <p class='text-center text-muted bg-light py-3 rounded border'>
                        <i class='bi bi-info-circle me-2'></i> No categories available at the moment.
                      </p>
                          ";
                    }
                    
                
            ?>
            </tbody>
        </table>

   
    </div>
</main>
<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>
