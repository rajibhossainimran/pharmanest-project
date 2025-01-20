<?php include('check_user.php'); ?>
      <!-- header part start  -->
      <?php 
       include("./pages/common_pages/header.php");
       
       ?>

       <?php include("./pages/common_pages/navber.php");?>
      <!-- header part end -->



        <!--Sidebar part start-->
        <?php 
       include("./pages/common_pages/sidebar.php");
       ?>
        <!--Sidebar part end-->
        
      <!-- main part start  -->
      <main  class="app-main">
      <div class="form-container p-5 mx-5">
          <div class="d-flex justify-content-between">
        <h2 class="">Add Customer</h2>
            <div>
            <a href="customer_list.php" class="btn btn-success d-block my-2" role="button">
        Show Customer List
        </a>
            </div>
        </div>
    <form method="POST" id="submitBrandForm" action="./php_action/creact_add_customer.php" enctype="multipart/form-data">
      <div class="row">
        <!-- Supplier Name -->
        <div class="col-md-12 mb-3">
          <label for="supplierName" class="form-label">Customer Name</label>
          <input type="text" name="customer_name" class="form-control" id="supplierName" required>
        </div>

        <!-- Mobile Number -->
        <div class="col-md-12 mb-3">
          <label for="mobileNumber" class="form-label">Mobile Number</label>
          <input type="tel" name="mobile" class="form-control" id="mobileNumber" required>
        </div>

      </div>

      <div class="row">
        <!-- Email -->
        <div class="col-md-12 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" required>
        </div>
      </div>
      <div class="col-md-12 mb-3">
          <label for="address" class="form-label">Home Address</label>
          <textarea class="form-control" name="address" id="address" rows="3" required></textarea>
        </div>

      <div class="row">
        <!-- City -->
        <div class="col-md-12 mb-3">
          <label for="city" class="form-label">Second Identifire Name</label>
          <input type="text" name="identifier_name" class="form-control" id="city" required>
        </div>

        <!-- State -->
        <div class="col-md-12 mb-3">
          <label for="state" class="form-label">Second Identitire Phone</label>
          <input type="text" name="identifier_mobile" class="form-control" id="state" required>
        </div>
      </div>
      <div class="row">
       <div class="col-md-12 mb-3">
       <div class="form-group row">
                <label class="col-sm-3 control-label" for="categoriesStatus">Status</label>
                <div class="col-md-12">
                  <select class="form-control" id="supplierStatus" name="customerStatus" required>
                    <option value="">-SELECT-</option>
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                  </select>
                </div>
              </div>

        </div>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="btn btn-success" name="create">Add New Customer</button>
      </div>
    </form>
</div>

  
      </main>
     
      <!-- main part end -->


        <!-- footer part start  -->
       <?php 
       include("./pages/common_pages/footer.php");
       ?>
       <!-- footer part end  -->



