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
        <h2 class="">Medicine List</h2>
            <div>
            <a href="add_medicine.php" class="btn btn-success d-block my-2" role="button">
        Add Medicine
        </a>
            </div>
        </div>
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-success">
            <tr>
                <th>SL</th>
                <th>Medicine Name</th>
                <th>Image</th>
                <th>Shelf</th>
                <th>Company</th>
                <th>Type</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                  $active_medicine='';
                    $supplier_list = $db->query("SELECT * FROM medicines");
                    if($supplier_list->num_rows > 0){
                      $counter = 1;
                      while (list($id,$m_name,$shelf,$company,$m_type,$genetic,$supplier,$status,$img) = $supplier_list->fetch_row())  {
                        if($status == 1) {
                            // activate member
                            $active_medicine = "<span class='badge bg-success'>Active</span>";
                          } else {
                            // deactivate member
                            $active_medicine = "<span class='badge bg-warning text-dark'>Inactive</span>";
                          }
                        echo "<tr>
                            <td>$counter</td>
                            <td>$m_name</td>
                            <td><img src='$img' alt='Medicine Image' class='img-thumbnail' style='max-width: 100px;'></td>
                            <td>$shelf</td>
                            <td>$company</td>
                            <td>$m_type</td>
                            <td>$supplier</td>
                            <td>$active_medicine</td>
                            <td>
                                  <a href='./edit_form_medicine.php?id=$id'' 
                                  class='btn btn-primary btn-sm text-white me-2' 
                                  data-bs-toggle='tooltip' 
                                  title='Edit'>
                                  <i class='bi bi-pencil-square'></i>
                                  </a>
              
                                  <a href='./php_action/delete_medicine.php?id=$id' class='btn btn-danger btn-sm text-white' data-bs-toggle='tooltip' 
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
