<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php';?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php");?>

<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php");?>
<?php include("./pages/common_pages/sidebar.php");?>
<?php

$id = intval($_GET['id']); 

$purchaseDetailSql = "SELECT * FROM sell_details WHERE id = $id";

$result = $db->query($purchaseDetailSql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $invoice = $row['invoice'];
    $supp_id= $row['customer_name'];
    $purchase_date = $row['sell_date'];
    $total_amount = $row['total_amount'];
    $discount = $row['discount'];
    $receive_amount = $row['receive_amount'];
    $due_amount = $row['due_amount'];
    $paymentStatus = $row['status'];

    
} else {
    echo "No records found for ID: $id";
}

// Close the result set
$result->close();
?>
<?php 
    // Fetch supplier details
    $supplierSql = "SELECT * FROM customer WHERE id = $supp_id";
    $rowSupplier = $db->query($supplierSql);

    if ($rowSupplier->num_rows > 0) {
        $getSupplier = $rowSupplier->fetch_assoc();
        $supplier_name = $getSupplier['customer_name'];
        $supplierCompany = $getSupplier['phone'];
    } else {
        $supplier_name = "Not Found";
        $supplierCompany = "Not Found";
    }
?>


<main class="app-main">
<div class="container mt-2 mb-5">
    <div class="d-flex justify-content-between">
        <h2 class="">Edit Purchase</h2>
            <div>
            <a href="sell_list.php" class="btn btn-success d-block my-2" role="button">
        Sells Lists
        </a>
            </div>
        </div>
  
    <form method="POST" id="purchaseBtnSubmit" action="./php_action/edit_sell.php?update=<?php echo $id;?>" enctype="multipart/form-data">
        <!-- Supplier Information -->
        <div class="row mb-4">
        <div class="col-md-6">
                <div class="mb-3">
                    <label for="supplierName" class="form-label">Supplier Name:</label>
                    <select class="form-control" id="medicineSupplier" name="medicine_supplier">
                    <option value="<?php echo $supp_id;?>"><?php echo $supplier_name;?></option>
                        <?php
                            $supplierclist = $db->query("SELECT * FROM customer");
                            while (list($_sid, $_sname) = $supplierclist->fetch_row()) {
                                echo "<option value='$_sid'>$_sname</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
               <div class="mb-3">
                    <label for="invoice" class="form-label">Invoice Number:</label>
                    <input type="text" name="invoice_number" class="form-control" id="randomNumber" value="<?php echo $invoice;?>" readonly>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
            <div class="mb-3">
                    <label for="purchaseDate" class="form-label">Purchase Date:</label>
                    <input type="date" name="purchase_date" class="form-control" id="purchaseDate" required value="<?php echo $purchase_date; ?>">
                </div>
            </div>
        </div>

        <!-- Hidden input for total amount -->
        <input type="hidden" name="total_amount" id="totalAmount">

        <!-- Medicine Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle" id="medicineTable">
                <thead class="table-success">
                    <tr>

                        <th scope="col">Medicine Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Cost</th>
                    </tr>
                </thead>

                <tbody>
                <?php
    $purchase_list = $db->query("SELECT * FROM sell_quantity WHERE sell_invoice = $invoice");
    if ($purchase_list->num_rows > 0) {
        while (list($id, $medicine_id, $quantity, $total_price, $qtnpurchase_invoice) = $purchase_list->fetch_row()) {

            // Get medicine name from medicines table 
            $mediSql = "SELECT * FROM medicines WHERE id = $medicine_id";
            $rowMedicine = $db->query($mediSql);
            $getMedicine = $rowMedicine->fetch_assoc();
            $medicine_name = $getMedicine['m_name'];

            echo "
            <tr>
                <td>
                    <select class='form-control' name='medicineName[]' required>
                        <option value='{$medicine_id}'>{$medicine_name}</option>";

            // PHP block for fetching medicines from the database
            $supplierclist = $db->query("SELECT * FROM medicines");
            while (list($_sid, $_sname) = $supplierclist->fetch_row()) {
                echo "<option value='{$_sid}'>{$_sname}</option>";
            }

            echo "
                    </select>
                </td>
                <td>
                    <input type='number' class='form-control' name='quantity[]' value='{$quantity}' readonly required>
                </td>
                <td>
                    <input type='number' class='form-control' name='totalCost[]' value='{$total_price}' readonly required>
                </td>
            </tr>";
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
        </div>

        <!-- <button title="add medicine" type="button" class="btn btn-primary" onclick="addMedicineRow()"><i class="bi bi-plus-square"></i></button> -->

        <!-- Payment Information -->
        <div class="row">
            <div class="col-md-6">
            <div class="mb-3">
                    <label for="subAmount" class="form-label">Sub Amount:</label>
                    <input type="number" value="<?php echo $total_amount;?>"  class="form-control" id="subAmount" placeholder="00.0" required>
                </div>
                
                <div class="mb-3">
                    <label for="payableAmount" class="form-label">Payable Amount:</label>
                    <input type="number" class="form-control" id="payableAmount" name="totalPayAmount" required>
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" value="<?php echo $discount;?>" name="discount" class="form-control" id="discount" placeholder="%">
                </div>
            </div>
            <div class="col-md-6">
                
               
                
                <div class="mb-3">
                    <label for="receivedAmount" class="form-label">Received Amount:</label>
                    <input type="number" value="<?php echo $receive_amount;?>" name="received_amount" class="form-control" id="receivedAmount" placeholder="Enter Amount">
                </div>
                <div class="mb-3">
                    <label for="dueAmount"  class="form-label">Due Amount:</label>
                    <input type="number" value="<?php echo $due_amount;?>" name="due_amount" class="form-control" id="dueAmount" required>
                </div>
                <div class="mb-3">
                    <label for="paymentStatus" class="form-label">Payment Status:</label>
                    <select class="form-control" id="paymentStatus" name="status">
                       
                        <option value="0" <?php 
                         if($paymentStatus=="0") 
                            { echo "selected";}?>>Paid</option>
                        <option value="1" <?php 
                         if($paymentStatus=="1") 
                            { echo "selected";}?>>Unpaid</option>
                        <option value="2" <?php 
                         if($paymentStatus=="2") 
                            { echo "selected";}?>>Partially Paid</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-4"></div>
            <div class="col-4 text-center">
            <button type="submit" class="btn btn-success" name="update">Update Now</button>

            </div>
            <div class="col-4"></div>
        </div>
    </form>
</div>
</main>

<!-- calculation part start  -->
<script>
    // Calculate the payable amount
    function calculatePayableAmount() {
        const subAmount = parseFloat(document.getElementById('subAmount').value) || 0;
        const discountInput = parseFloat(document.getElementById('discount').value) || 0;
        const discount = subAmount * (discountInput / 100);
        const payableAmount = subAmount - discount;
        document.getElementById('payableAmount').value = payableAmount.toFixed(0);
        document.getElementById('totalAmount').value = subAmount.toFixed(0); // Set total amount
        calculateDueAmount(); // Update due amount whenever payable amount changes
    }

    // Calculate the due amount
    function calculateDueAmount() {
        const payableAmount = parseFloat(document.getElementById('payableAmount').value) || 0;
        const receivedAmount = parseFloat(document.getElementById('receivedAmount').value) || 0;
        const dueAmount = payableAmount - receivedAmount;
        document.getElementById('dueAmount').value = dueAmount.toFixed(0);
    }

    // Calculate the due amount when the received amount changes
    document.getElementById('receivedAmount').addEventListener('input', function() {
        calculateDueAmount();
    });

    // Calculate the payable amount when the sub amount or discount changes
    document.getElementById('subAmount').addEventListener('input', function() {
        calculatePayableAmount();
    });

    document.getElementById('discount').addEventListener('input', function() {
        calculatePayableAmount();
    });

    // Calculate the due amount when the payable amount changes
    document.getElementById('payableAmount').addEventListener('input', function() {
        calculateDueAmount();
    });

    // Calculate the total cost and payable amount when the form is submitted
    document.getElementById('purchaseBtnSubmit').addEventListener('submit', function(event) {
        calculatePayableAmount();
        calculateDueAmount();
    });

    // Initial calculation
    document.addEventListener('DOMContentLoaded', function() {
        calculatePayableAmount();
        calculateDueAmount();
    });

    // Function to add a new row to the medicine table
    function addMedicineRow() {
    const table = document.getElementById('medicineTable').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();

    // Medicine Name
    const cell1 = newRow.insertCell(0);
    const select1 = document.createElement('select');
    select1.className = 'medicine-select form-control';
    select1.name = 'medicineName[]';
    select1.required = true;

    // Add placeholder option
    const placeholderOption = document.createElement('option');
    placeholderOption.textContent = 'Select medicine';
    placeholderOption.value = '';
    placeholderOption.disabled = true;
    placeholderOption.selected = true;
    select1.appendChild(placeholderOption);

    // Fetch medicine data
    // fetch('php_action/api_medicines.php')
    //     .then((response) => response.json())
    //     .then((data) => {
    //         data.forEach((medicine) => {
    //             const option = document.createElement('option');
    //             option.value = medicine.id;
    //             option.textContent = medicine.m_name;
    //             select1.appendChild(option);
    //         });
    //     })
    //     .catch((error) => {
    //         console.error('Error fetching medicines:', error);
    //         alert('Failed to load medicines. Please try again.');
    //     });
    // cell1.appendChild(select1);

    // Available Quantity
    const cell2 = newRow.insertCell(1);
    const input2 = document.createElement('input');
    input2.type = 'number';
    input2.className = 'form-control available-quantity';
    input2.name = 'availableQuantity[]';
    input2.placeholder = '0';
    input2.readOnly = true; 
    cell2.appendChild(input2);

    // Quantity
    const cell3 = newRow.insertCell(2);
    const input3 = document.createElement('input');
    input3.type = 'number';
    input3.className = 'form-control quantity-input';
    input3.name = 'quantity[]';
    input3.placeholder = '0';
    input3.required = true;
    input3.addEventListener('input', () => {
        calculateTotalCost(newRow);
        calculateSubAmount();
    });
    cell3.appendChild(input3);

    // Supplier Price
    const cell4 = newRow.insertCell(3);
    const input4 = document.createElement('input');
    input4.type = 'number';
    input4.className = 'price-field form-control supplier-price';
    input4.name = 'supplierPrice[]';
    input4.placeholder = '00.0';
    input4.required = true;
    input4.addEventListener('input', () => {
        calculateTotalCost(newRow);
        calculateSubAmount();
    });
    cell4.appendChild(input4);

    // Total Cost
    const cell5 = newRow.insertCell(4);
    const input5 = document.createElement('input');
    input5.type = 'number';
    input5.className = 'form-control total-cost';
    input5.name = 'totalCost[]';
    input5.placeholder = '00.0';
    input5.readOnly = true; // Make this field read-only
    cell5.appendChild(input5);

    // Remove Button
    const cell6 = newRow.insertCell(5);
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'btn btn-danger btn-sm';
    button.innerHTML = '<i class="bi bi-trash"></i>';
    button.addEventListener('click', () => {
        removeMedicineRow(button);
        calculateSubAmount();
    });
    cell6.appendChild(button);

}

    // Function to remove a row from the medicine table
    function removeMedicineRow(button) {
        const row = button.closest('tr'); // Find the closest table row to the clicked button
        row.remove(); 
        calculateSubAmount();
    }

    function calculateTotalCost(row) {
        const quantity = row.querySelector('input[name="quantity[]"]').value;
        const supplierPrice = row.querySelector('input[name="supplierPrice[]"]').value;
        const totalCostInput = row.querySelector('input[name="totalCost[]"]');

        // Calculate total cost
        const totalCost = (quantity && supplierPrice) ? quantity * supplierPrice : 0;

        // Set total cost value
        totalCostInput.value = totalCost.toFixed(2);
    }

    function calculateSubAmount() {
        const totalCostInputs = document.querySelectorAll('input[name="totalCost[]"]');
        let subAmount = 0;

        totalCostInputs.forEach(input => {
            subAmount += parseFloat(input.value) || 0;
        });

        document.getElementById('subAmount').value = subAmount.toFixed(2); 
        calculatePayableAmount();
    }

    // Add event listeners to the initial row
    document.addEventListener('DOMContentLoaded', function() {
        const initialRow = document.querySelector('#medicineTable tbody tr');
        if (initialRow) {
            initialRow.querySelector('input[name="quantity[]"]').addEventListener('input', () => {
                calculateTotalCost(initialRow);
                calculateSubAmount();
            });
            initialRow.querySelector('input[name="supplierPrice[]"]').addEventListener('input', () => {
                calculateTotalCost(initialRow);
                calculateSubAmount();
            });
        }
    });
</script>

</main>
<!-- main part end -->

<!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>