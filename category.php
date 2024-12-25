 
<?php include('check_user.php'); ?>
<!-- header part  -->
 <?php  include("./pages/common_pages/header.php");?>



        <!--navber and sideber part start-->
 <?php include("./pages/common_pages/navber.php");?>
 <?php include("./pages/common_pages/sidebar.php");?>

        
      <!-- main part start  -->
    <main class="app-main">
        <!-- add category section part start  -->
    <div class="container mt-5">
    <!-- Form Section -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <!-- display error message  -->
        <?php
        // Display success or error messages

        // Display success or error messages
        if (isset($_SESSION['success'])) {
            echo "<p id='message' style='color: green;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
            unset($_SESSION['success']); // Clear the message after displaying it
        }
        
        if (isset($_SESSION['error'])) {
            echo "<p id='message' style='color: red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
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
    
   </section>
  </main>
     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                