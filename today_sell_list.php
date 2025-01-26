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
            <h2 class="">Sells Lists</h2>
            <div>
                <a href="add_new_sell.php" class="btn btn-success d-block my-2" role="button">
                    Add New Sell
                </a>
            </div>
        </div>
        <!-- display error message  -->
        <?php
        if (isset($_SESSION['success'])) {
            echo "<p id='message' style='color: green;font-size: 30px;background-color: lightgreen; text-align: center; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
            unset($_SESSION['success']); // Clear the message after displaying it
        }

        if (isset($_SESSION['error'])) {
            echo "<p id='message' style='color: red;font-size: 30px;background-color: lightred; text-align: center; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']); // Clear the message after displaying it
        }

        // <!-- delete success or unsuccess message  -->
      
        if (isset($_SESSION['purchaseSuccess'])) {
            echo "<p id='message' style='color: green;font-size: 30px;background-color: lightgreen; text-align: center; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px;'>" . htmlspecialchars($_SESSION['purchaseSuccess']) . "</p>";
            unset($_SESSION['purchaseSuccess']); // Clear the message after displaying it
        }

        if (isset($_SESSION['purchaseError'])) {
            echo "<p id='message' style='color: red;font-size: 30px;background-color: lightred; text-align: center; padding-left: 20px; padding-right: 20px; margin-left: 10px; margin-right: 10px;'>" . htmlspecialchars($_SESSION['purchaseError']) . "</p>";
            unset($_SESSION['purchaseError']); // Clear the message after displaying it
        }
        
        ?>


        <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
 $today = date('Y-m-d');

$purchase_status = '';
$purchase_list = $db->query("SELECT * FROM sell_details WHERE sell_date = '$today'");
if ($purchase_list->num_rows > 0) {
    $counter = 1;
    while (list($id, $invoice, $supp_name, $purchase_date, $Total_amount, $discount, $receive_amount, $due_amount, $status) = $purchase_list->fetch_row()) {

        // Get supplier name from supplier_add table
        $sql = "SELECT customer_name FROM customer WHERE id = $supp_name";
        $rowSupplier = $db->query($sql);
        $getSupplier = $rowSupplier->fetch_assoc();
        $supplier_name = $getSupplier['customer_name'];

        if ($status == 0) {
            $purchase_status = "<span class='badge bg-success'>Paid</span>";
        } elseif ($status == 1) {
            $purchase_status = "<span class='badge bg-danger text-dark'>Unpaid</span>";
        } else {
            $purchase_status = "<span class='badge bg-warning text-dark'>Partially paid</span>";
        }

        echo "<tr>
              <td>$counter</td>
              <td>$invoice</td>
              <td>$purchase_date</td>
              <td>$Total_amount</td>
              <td>$purchase_status</td>
              <td>
                    <a href='view_sell_details.php?id=$id' class='btn btn-info btn-sm text-white me-2' data-bs-toggle='tooltip' title='View'>
                    <i class='bi bi-eye'></i>
                    </a>

                    <a href='edit_sell_form.php?id=$id' class='btn btn-primary btn-sm text-white me-2' data-bs-toggle='tooltip' title='Edit'>
                    <i class='bi bi-pencil-square'></i>
                    </a>
      
                    <button type='button' class='btn btn-danger btn-sm text-white' data-bs-toggle='modal' data-bs-target='#deleteModal$id' title='Delete'>
                    <i class='bi bi-trash'></i>
                    </button>
                </td>
          </tr>";

        // Modal for delete confirmation
        echo "<div class='modal fade' id='deleteModal$id' tabindex='-1' aria-labelledby='deleteModalLabel$id' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'> 
                        <div class='modal-header d-flex justify-content-end'>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div> 
                        <div class='modal-body'>
                            <h5 class='text-center'>Are you sure you want to delete this record?</h5>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                            <a href='./php_action/delete_sell.php?id=$id' class='btn btn-danger'>Delete</a>
                        </div>
                    </div>
                </div>
             </div>";
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
    <script>
        // Hide the message after 3 seconds
        setTimeout(() => {
            const messageElement = document.getElementById('message');
            if (messageElement) {
                messageElement.style.display = 'none';
            }
        }, 2000);
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</main>
<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>