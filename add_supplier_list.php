 
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
        
      <!-- main part start  -->
    <main  class="app-main">
        <!-- add unit section part start  -->
  

   <!-- show message for 3 second using javascript code -->
   <script>
    // Hide the message after 3 seconds
    setTimeout(() => {
        const messageElement = document.getElementById('message');
        if (messageElement) {
            messageElement.style.display = 'none';
        }
    }, 3000);
</script>

  <!-- display category list  -->
   <section>
   <div class="container my-5">
        <div class="d-flex justify-content-between">
        <h2 class="">Supplier List</h2>
            <div>
            <a href="add_supplier.php" class="btn btn-success d-block my-2" role="button">
        Add Supplier
        </a>
            </div>
        </div>
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
                    $active_supplier='';
                    $supplier_list = $db->query("SELECT * FROM supplier_add");
                    if($supplier_list->num_rows > 0){
                      $counter = 1;
                      while (list($id,$supplier_name,$company,$mobile,$email,$address,$city,$state,$balance,$status) = $supplier_list->fetch_row()) {
                        if($status == 1) {
                          // activate member
                          $active_supplier = "<span class='badge bg-success'>Active</span>";
                        } else {
                          // deactivate member
                          $active_supplier = "<span class='badge bg-warning text-dark'>Inactive</span>";
                        }
    
                              echo "<tr>
                              <td>$counter</td>
                              <td>$supplier_name</td>
                              <td>$company</td>
                              <td>$mobile</td>
                              <td>$email</td>
                              <td>$address</td>
                              <td>$city</td>
                              <td>$active_supplier</td>
                              <td>
                                  <a href='./edito_form_supplier.php?id=$id'' 
                                  class='btn btn-primary btn-sm text-white me-2' 
                                  data-bs-toggle='tooltip' 
                                  title='Edit'>
                                  <i class='bi bi-pencil-square'></i>
                                  </a>
              
                                  <a href='./php_action/delete_supplier.php?id=$id' class='btn btn-danger btn-sm text-white' data-bs-toggle='tooltip' 
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
    
    <!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">
                    <?php echo ($type === 'success') ? 'Success' : 'Error'; ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo htmlspecialchars($message_delete); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Check if a message is set and display the modal
    <?php if ($message_delete): ?>
    var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
    messageModal.show();
    <?php endif; ?>
</script>

   </section>
  </main>
     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                