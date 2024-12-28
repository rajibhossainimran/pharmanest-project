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
    
    <?php 
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql="SELECT * from supplier_add where id=$id";
    $result=$db->query($sql)->fetch_assoc();

}

?>
        <!--Sidebar part end-->
        
      <!-- main part start  -->
      <main  class="app-main">
      <div class="form-container p-5">
    <h3>Add Supplier</h3>
    <form class="form-horizontal" method="POST" id="submitBrandForm" action="./php_action/edit_supplier.php?update=<?php echo $id;?>" enctype="multipart/form-data">
      <div class="row">
        <!-- Supplier Name -->
        <div class="col-md-6 mb-3">
          <label for="supplierName" class="form-label">Supplier Name</label>
          <input type="text" value="<?php echo $result['supplier_name']?>" name="supplier_name" class="form-control" id="supplierName" required>
        </div>

        <!-- Company -->
        <div class="col-md-6 mb-3">
          <label for="company" class="form-label">Company</label>
          <input type="text" value="<?php echo $result['company']?>"  name="company" class="form-control" id="company" required>
        </div>
      </div>

      <div class="row">
        <!-- Mobile Number -->
        <div class="col-md-6 mb-3">
          <label for="mobileNumber" class="form-label">Mobile Number</label>
          <input type="tel" value="<?php echo $result['mobile']?>"  name="mobile" class="form-control" id="mobileNumber" required>
        </div>

        <!-- Email -->
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" value="<?php echo $result['email']?>"  name="email" class="form-control" id="email" required>
        </div>
      </div>

      <div class="row">
        <!-- Supplier Address -->
        <div class="col-md-12 mb-3">
          <label for="address" class="form-label">Supplier Address</label>
          <textarea class="form-control" name="address" id="address" rows="3" required><?php echo $result['address']; ?></textarea>

        </div>
      </div>

      <div class="row">
        <!-- City -->
        <div class="col-md-6 mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" value="<?php echo $result['city']?>"  name="city" class="form-control" id="city" required>
        </div>

        <!-- State -->
        <div class="col-md-6 mb-3">
          <label for="state" class="form-label">State</label>
          <input type="text" value="<?php echo $result['state']?>"  name="state" class="form-control" id="state" required>
        </div>
      </div>
      <div class="row">
       <div class="col-md-6 mb-3">
       <div class="col-sm-9">
                    <select class="form-control" id="categoriesStatus" name="supplierStatus">
                        <option value="1" <?php 
                         if($result['status']=="1") 
                            { echo "selected";}?>>Available</option>

                        <option value="2" <?php if($result['status']=="2"){ echo "selected";}?>>Not Available</option>
                    </select>
                </div>

        </div>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="btn btn-success" name="update">Update Now</button>
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



