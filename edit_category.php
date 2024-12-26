 
<?php include('check_user.php'); ?>
<!-- database  -->
 <?php require_once './config/config.php';?>
<!-- header part  -->
 <?php  include("./pages/common_pages/header.php");?>

        <!--navber and sideber part start-->
 <?php include("./pages/common_pages/navber.php");?>
 <?php include("./pages/common_pages/sidebar.php");?>
<?php 
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql="SELECT * from category where id=$id";
    $result=$db->query($sql)->fetch_assoc();

}

?>
        
      <!-- main part start  -->
    <main  class="app-main">
    <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <!-- display error message  -->
        <div class="card">
          <div class="card-header">
            <h4>Edit Category</h4>
          </div>
          <div class="card-body">
            <div id="add-brand-messages"></div>
            <form class="form-horizontal" method="POST" id="submitBrandForm" action="./php_action/editCategory.php?update=<?php echo $id;?>" enctype="multipart/form-data">
              <!-- Categories Name -->
              <div class="form-group row">
                <label class="col-sm-3 control-label" for="categoriesName">Category Name</label>
                <div class="col-sm-9 mb-2">
                  <input 
                    type="text" 
                    class="form-control" 
                    name="category" 
                    value="<?php echo $result['category_name']?>"
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
                <div class="col-sm-9">
                    <select class="form-control" id="categoriesStatus" name="categoriesStatus">
                        <option value="1" <?php 
                         if($result['category_status']=="1") 
                            { echo "selected";}?>>Available</option>

                        <option value="2" <?php if($result['category_status']=="2"){ echo "selected";}?>>Not Available</option>
                    </select>
                </div>
              </div>


              <!-- Submit Button -->
              <div class="form-group row">
                <div class="col-sm-12 text-end mt-3">
                  <button type="submit" name="update"  class="btn btn-success">
                    Update Now
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
  </main>
     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                