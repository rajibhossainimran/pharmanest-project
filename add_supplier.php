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
      <div class="form-container p-5">
          <div class="d-flex justify-content-between">
        <h2 class="">Add Supplier</h2>
            <div>
            <a href="add_supplier_list.php" class="btn btn-success d-block my-2" role="button">
        Show Supplier List
        </a>
            </div>
        </div>
    <form method="POST" id="submitBrandForm" action="./php_action/create_add_supplier.php" enctype="multipart/form-data">
      <div class="row">
        <!-- Supplier Name -->
        <div class="col-md-6 mb-3">
          <label for="supplierName" class="form-label">Supplier Name</label>
          <input type="text" name="supplier_name" class="form-control" id="supplierName" required>
        </div>

        <!-- Company -->
        <div class="col-md-6 mb-3">
          <label for="company" class="form-label">Company</label>
          <input type="text" name="company" class="form-control" id="company" required>
        </div>
      </div>

      <div class="row">
        <!-- Mobile Number -->
        <div class="col-md-6 mb-3">
          <label for="mobileNumber" class="form-label">Mobile Number</label>
          <input type="tel" name="mobile" class="form-control" id="mobileNumber" required>
        </div>

        <!-- Email -->
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" required>
        </div>
      </div>

      <div class="row">
        <!-- Supplier Address -->
        <div class="col-md-12 mb-3">
          <label for="address" class="form-label">Supplier Address</label>
          <textarea class="form-control" name="address" id="address" rows="3" required></textarea>
        </div>
      </div>

      <div class="row">
        <!-- City -->
        <div class="col-md-6 mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" name="city" class="form-control" id="city" required>
        </div>

        <!-- State -->
        <div class="col-md-6 mb-3">
          <label for="state" class="form-label">State</label>
          <input type="text" name="state" class="form-control" id="state" required>
        </div>
      </div>
      <div class="row">
       <div class="col-md-6 mb-3">
       <div class="form-group row">
                <label class="col-sm-3 control-label" for="categoriesStatus">Status</label>
                <div class="col-sm-9">
                  <select class="form-control" id="supplierStatus" name="supplierStatus" required>
                    <option value="">-SELECT-</option>
                    <option value="1">Available</option>
                    <option value="2">Not Available</option>
                  </select>
                </div>
              </div>

        </div>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="btn btn-success" name="create">Submit</button>
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



