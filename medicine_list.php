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
    <div class="container mt-2 mb-5">
    <h1>Medicine List</h1>
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>SL</th>
                <th>Medicine Name</th>
                <th>Image</th>
                <th>Company</th>
                <th>Type</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            if ($result->num_rows > 0) {
                while (list($id,$m_name,$shelf,$company,$m_type,$genetic,$supplier,$status,$img) = $supplier_list->fetch_row()) {
                    if($status == 1) {
                        // activate member
                        $active_medicine = "<span class='badge bg-success'>Active</span>";
                      } else {
                        // deactivate member
                        $active_medicine = "<span class='badge bg-warning text-dark'>Inactive</span>";
                      }
                    $count++;
                    echo "<tr>
                        <td>$count</td>
                        <td>$m_name</td>
                        <td><img src='$img' alt='Medicine Image' class='img-thumbnail' style='max-width: 100px;'></td>
                        <td>$company</td>
                        <td>$m_type</td>
                        <td>$supplier</td>
                        <td>$active_medicine</td>
                                                
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No data found</td></tr>";
            }
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
                        $count++;
                        echo "<tr>
                            <td>$counter</td>
                            <td>$m_name</td>
                            <td><img src='$img' alt='Medicine Image' class='img-thumbnail' style='max-width: 100px;'></td>
                            <td>$company</td>
                            <td>$m_type</td>
                            <td>$supplier</td>
                            <td>$active_medicine</td>
                                                    
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
