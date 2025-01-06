 
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

    $sql="SELECT * from medicines where id=$id";
    $result=$db->query($sql)->fetch_assoc();

}

?>
        
        <main class="app-main">
    <div class="container mt-2 mb-5">
        <h2>Update Medicine</h2>
        <form action="./php_action/edit_medicine_list.php?update=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="medicineName" class="form-label">Medicine Name:</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="medicineName" 
                        value="<?php echo $result['m_name']?>"
                        name="medicine_name" required>
                        <!-- medicine name suggestion box -->
                        <div id="autocompleteList" class="autocomplete-list"></div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                        <label for="shelfNo" class="form-label">Shelf No:</label>
                        <input 
                        type="text" 
                        class="form-control"
                        value="<?php echo $result['shelf_no']?>" 
                        id="shelfNo" 
                        name="shelf_no" required>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="manufacturer" class="form-label">Manufacturer:</label>
                        <input 
                        type="text" 
                        value="<?php echo $result['manufacturer']?>"
                        class="form-control" 
                        id="manufacturer" 
                        name="manufacturer" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="medicineType" class="form-label">Medicine Type:</label>
                        <select class="form-control" id="medicineType" name="medicine_type">
                        <option value="">--Select medicine type--</option>
                        <?php
                            $selected_type = $result['m_type']; // Replace with the correct field that contains the selected value

                            $manufaclist = $db->query("SELECT * FROM medicine_type");
                            while (list($_bid, $_bname) = $manufaclist->fetch_row()) {
                                $selected = ($_bname === $selected_type) ? "selected" : "";
                                echo "<option value='$_bname' $selected>$_bname</option>";
                            }
                        ?>
                    </select>

                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="genericName" class="form-label">Generic Name:</label>
                        <input type="text" 
                        class="form-control" 
                        value="<?php echo $result['genetic']?>"
                        id="genericName" 
                        name="generic_name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="supplierName" class="form-label">Supplier Name:</label>
                        <select class="form-control" id="medicineSupplier" name="medicine_supplier">
                        <option value="">--Select supplier--</option>
                        <?php
                            $supplierclist = $db->query("SELECT * FROM supplier_add");
                            $selected_supplier = $result['supplier']; // The value you want to set as selected

                            while (list($_sid, $_sname) = $supplierclist->fetch_row()) {
                                $selected = ($_sname === $selected_supplier) ? "selected" : "";
                                echo "<option value='$_sname' $selected>$_sname</option>";
                            }
                        ?>
                    </select>

                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="medicineStatus" class="form-label">Medicine Status:</label>
                        <select class="form-control" id="medicineStatus" name="medicine_status">
                        <option value="1" <?php 
                         if($result['status']=="1") 
                            { echo "selected";}?>>Available</option>

                        <option value="2" <?php if($result['status']=="2"){ echo "selected";}?>>Not Available</option>
                    </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <button type="submit" class="btn btn-success" name="update">Update Medicine</button>
                </div>
                <div class="col-4"></div>
            </div>
        </form>
    </div>
</main>
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

     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                