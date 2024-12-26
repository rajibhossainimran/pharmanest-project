 
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
        <!-- add category section part start  -->
    <div class="container mt-5">

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <!-- display error message  -->
        <?php
        if (isset($_SESSION['success'])) {
            echo "<p id='message' style='color: green;font-size: 25px;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
            unset($_SESSION['success']); // Clear the message after displaying it
        }
        
        if (isset($_SESSION['error'])) {
            echo "<p id='message' style='color: red;font-size: 25px;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']); // Clear the message after displaying it
        }
        ?>


        <div class="card">
          <div class="card-header">
            <h4>Add Category</h4>
          </div>
          <div class="card-body">
            <div id="add-brand-messages"></div>
            <form class="form-horizontal" method="POST" id="submitBrandForm" action="./php_action/create_categories.php" enctype="multipart/form-data">
              <!-- Categories Name -->
              <div class="form-group row">
                <label class="col-sm-3 control-label" for="categoriesName">Category Name</label>
                <div class="col-sm-9 mb-2">
                  <input 
                    type="text" 
                    class="form-control" 
                    name="category" 
                    placeholder="Category Name" 
                    required 
                    pattern="^[a-zA-Z\s]+$" 
                    title="Only alphabets are allowed.">
                </div>
              </div>

              <!-- Status -->
              <div class="form-group row">
                <label class="col-sm-3 control-label" for="categoriesStatus">Status</label>
                <div class="col-sm-9">
                  <select class="form-control" id="categoriesStatus" name="categoriesStatus" required>
                    <option value="">-SELECT-</option>
                    <option value="1">Available</option>
                    <option value="2">Not Available</option>
                  </select>
                </div>
              </div>


              <!-- Submit Button -->
              <div class="form-group row">
                <div class="col-sm-12 text-end mt-3">
                  <button type="submit" name="create" id="createCategoriesBtn" class="btn btn-success">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

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
        <h2 class="mb-4 text-center">Category List</h2>
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
                    $activeCategory='';
                    $category_list = $db->query("SELECT * FROM category");
                    if($category_list->num_rows > 0){
                      $counter = 1;
                      while (list($id,$category,$status) = $category_list->fetch_row()) {
                        if($status == 1) {
                          // activate member
                          $activeCategory = "<span class='badge bg-success'>Active</span>";
                        } else {
                          // deactivate member
                          $activeCategory = "<span class='badge bg-warning text-dark'>Inactive</span>";
                        }
    
                              echo "<tr>
                              <td>$counter</td>
                              <td>$category</td>
                              <td>$activeCategory</td>
                              <td>
                                  <a href='./edit_category.php?id=$id'' 
                                  class='btn btn-primary btn-sm text-white me-2' 
                                  data-bs-toggle='tooltip' 
                                  title='Edit'>
                                  <i class='bi bi-pencil-square'></i>
                                  </a>
              
                                  <a href='./php_action/category_delete.php?id=$id' class='btn btn-danger btn-sm text-white' data-bs-toggle='tooltip' 
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



    
   
                