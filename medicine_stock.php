<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>
<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>
<main class="app-main">
    <div class="container mt-2 mb-5 py-5">
        <div class="">
            <h2 class="text-center mb-4">Medicine Stock</h2>
        </div>
        <!-- display error message  -->

        <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Medicine Name</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Purchase Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $purchase_status = '';
            $purchase_list = $db->query("SELECT * FROM medicine_stock");
            if ($purchase_list->num_rows > 0) {
                $counter = 1;
                while (list($id,$batchNo,$medicine_id,$quantity,$supp_price,$sell_price,$expire_date,$purchase_invoice) = $purchase_list->fetch_row()) {

                    // Get supplier name from supplier_add table
                    $sql = "SELECT * FROM medicines WHERE id = $medicine_id";
                    $rowMedicine = $db->query($sql);
                    $getMedicine = $rowMedicine->fetch_assoc();
                    $medicine_name = $getMedicine['m_name'];
                    $company = $getMedicine['manufacturer'];

        echo "<tr>
              <td>$counter</td>
              <td>$medicine_name</td>
              <td>$company</td>
              <td>$sell_price</td>
              <td>$supp_price</td>
              <td>$quantity</td>
              <td>
                    <a href='view_stock_details.php?id=$id' class='btn btn-info btn-sm text-white me-2' data-bs-toggle='tooltip' title='View'>
                    <i class='bi bi-eye'></i>
                    </a>
                </td>
          </tr>";
        $counter++;
    }
} else {
    echo "
      <p class='text-center text-muted bg-light py-3 rounded border'>
        <i class='bi bi-info-circle me-2'></i> No purchase available at the moment.
      </p>";
}
?>

            </tbody>
        </table>






        <!-- delete modal part start  -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content"> <!-- Modal Header -->
                    <div class="modal-header d-flex justify-content-end">

                        <button type="button" class="btn btn-secondary ms-5" data-dismiss="modal"><i class="bi bi-x-lg"></i></button>

                    </div> <!-- Modal Body -->
                    <div class="d-flex">
                        <h5 class="text-center ms-5">Are you sure you want to delete</h5>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">

                        <a href='#'
                            data-dismiss="modal"
                            class='btn btn-danger btn-sm text-white py-2 px-3 ' data-bs-toggle='tooltip'
                            title='Delete'>
                            <i class='bi bi-trash'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- delete modal part end  -->

    </div>

</main>
<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>