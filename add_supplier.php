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
    <h3>Add Supplier</h3>
    <form>
      <div class="row">
        <!-- Supplier Name -->
        <div class="col-md-6 mb-3">
          <label for="supplierName" class="form-label">Supplier Name</label>
          <input type="text" class="form-control" id="supplierName" required>
        </div>

        <!-- Company -->
        <div class="col-md-6 mb-3">
          <label for="company" class="form-label">Company</label>
          <input type="text" class="form-control" id="company" required>
        </div>
      </div>

      <div class="row">
        <!-- Mobile Number -->
        <div class="col-md-6 mb-3">
          <label for="mobileNumber" class="form-label">Mobile Number</label>
          <input type="tel" class="form-control" id="mobileNumber" required>
        </div>

        <!-- Email -->
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" required>
        </div>
      </div>

      <div class="row">
        <!-- Supplier Address -->
        <div class="col-md-12 mb-3">
          <label for="address" class="form-label">Supplier Address</label>
          <textarea class="form-control" id="address" rows="3" required></textarea>
        </div>
      </div>

      <div class="row">
        <!-- City -->
        <div class="col-md-6 mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" class="form-control" id="city" required>
        </div>

        <!-- State -->
        <div class="col-md-6 mb-3">
          <label for="state" class="form-label">State</label>
          <input type="text" class="form-control" id="state" required>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="btn btn-success">Submit</button>
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



