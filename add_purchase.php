<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php';?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php");?>

<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php");?>
<?php include("./pages/common_pages/sidebar.php");?>
<?php 
$message_delete = isset($_GET['message_delete']) ? $_GET['message_delete'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;
?>



<main class="app-main">
<div class="container mt-2 mb-5">
    <div class="d-flex justify-content-between">
        <h2 class="">Add Purchase</h2>
            <div>
            <a href="purchase_list.php" class="btn btn-success d-block my-2" role="button">
        Vew Purchase List
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
        ?>
    <form method="POST" id="purchaseBtnSubmit" action="./php_action/create_purchase.php" enctype="multipart/form-data">
        <!-- Supplier Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="supplierName" class="form-label">Supplier Name:</label>
                    <select class="form-control" id="medicineSupplier" name="medicine_supplier">
                        <option value="">--Select supplier--</option>
                        <?php
                            $supplierclist = $db->query("SELECT * FROM supplier_add");
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
                    <input type="text" name="invoice_number" class="form-control" id="randomNumber" readonly>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="purchaseDate" class="form-label">Purchase Date:</label>
                    <input type="date" name="purchase_date" class="form-control" id="purchaseDate" required value="<?php echo date('Y-m-d'); ?>">
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
                        <th scope="col">Batch No</th>
                        <th scope="col">Medicine Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Supplier Price</th>
                        <th scope="col">Sell Price</th>
                        <th scope="col">Expiry Date</th>
                        <th scope="col">Total Cost</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="batchNo[]" placeholder="Enter batch no" required></td>
                        <td><select class="form-control" name="medicineName[]" required>
                            <option value="">--Select medicine--</option>
                            <?php
                                $supplierclist = $db->query("SELECT * FROM medicines");
                                while (list($_sid, $_sname) = $supplierclist->fetch_row()) {
                                    echo "<option value='$_sid'>$_sname</option>";
                                }
                            ?>
                            </select></td>
                        <td><input type="number" class="form-control" name="quantity[]" placeholder="0" required></td>
                        <td><input type="number" class="form-control" name="supplierPrice[]" placeholder="00.0" required></td>
                        <td><input type="number" class="form-control" name="sellPrice[]" placeholder="00.0" required></td>
                        <td><input type="date" class="form-control" name="expiryDate[]" required></td>
                        <td><input type="number" class="form-control" name="totalCost[]" placeholder="00.0" required></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeMedicineRow(this)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button title="add medicine" type="button" class="btn btn-primary" onclick="addMedicineRow()"><i class="bi bi-plus-square"></i></button>

        <!-- Payment Information -->
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="subAmount" class="form-label">Sub Amount:</label>
                    <input type="number" class="form-control" id="subAmount" placeholder="00.0" required>
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" name="discount" class="form-control" id="discount" placeholder="%">
                </div>
                <div class="mb-3">
                    <label for="payableAmount" class="form-label">Payable Amount:</label>
                    <input type="number" class="form-control" id="payableAmount" name="totalPayAmount" required>
                </div>
                <div class="mb-3">
                    <label for="receivedAmount" class="form-label">Received Amount:</label>
                    <input type="number" name="received_amount" class="form-control" id="receivedAmount" placeholder="Enter Amount">
                </div>
                <div class="mb-3">
                    <label for="dueAmount" class="form-label">Due Amount:</label>
                    <input type="number" name="due_amount" class="form-control" id="dueAmount" required>
                </div>
                <div class="mb-3">
                    <label for="paymentStatus" class="form-label">Payment Status:</label>
                    <select class="form-control" id="paymentStatus" name="status">
                        <option value="0">Paid</option>
                        <option value="1">Unpaid</option>
                        <option value="2">Partially Paid</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-4"></div>
            <div class="col-4 text-center">
            <button type="submit" class="btn btn-success" name="purchaseBtn">Submit</button>

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

        // Batch Number
        const cell1 = newRow.insertCell(0);
        const input1 = document.createElement('input');
        input1.type = 'text';
        input1.className = 'form-control';
        input1.name = 'batchNo[]';
        input1.placeholder = 'Enter batch no';
        input1.required = true;
        cell1.appendChild(input1);

        // Medicine Name
        const cell2 = newRow.insertCell(1);
        const select2 = document.createElement('select');
        select2.className = 'form-control';
        select2.name = 'medicineName[]';
        select2.required = true;

        // Add placeholder option
        const placeholderOption = document.createElement('option');
        placeholderOption.textContent = 'Select medicine';
        placeholderOption.value = '';
        placeholderOption.disabled = true;
        placeholderOption.selected = true;
        select2.appendChild(placeholderOption);

        // fetch data 
        fetch('php_action/api_medicines.php')
        .then(response => response.json()) 
        .then(data => {
            data.forEach(supplier => {
                const option = document.createElement('option');
                option.value = supplier.id;
                option.textContent = supplier.m_name;
                console.log(supplier.m_name, supplier.id);
                select2.appendChild(option);
            });
        });
        cell2.appendChild(select2);

        // Quantity
        const cell3 = newRow.insertCell(2);
        const input3 = document.createElement('input');
        input3.type = 'number';
        input3.className = 'form-control';
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
        input4.className = 'form-control';
        input4.name = 'supplierPrice[]';
        input4.placeholder = '00.0';
        input4.required = true;
        input4.addEventListener('input', () => {
            calculateTotalCost(newRow);
            calculateSubAmount();
        });
        cell4.appendChild(input4);

        // Sell Price
        const cell5 = newRow.insertCell(4);
        const input5 = document.createElement('input');
        input5.type = 'number';
        input5.className = 'form-control';
        input5.name = 'sellPrice[]';
        input5.placeholder = '00.0';
        input5.required = true;
        cell5.appendChild(input5);

        // Expiry Date
        const cell6 = newRow.insertCell(5);
        const input6 = document.createElement('input');
        input6.type = 'date';
        input6.className = 'form-control';
        input6.name = 'expiryDate[]';
        input6.required = true;
        cell6.appendChild(input6);

        // Total Cost
        const cell7 = newRow.insertCell(6);
        const input7 = document.createElement('input');
        input7.type = 'number';
        input7.className = 'form-control';
        input7.name = 'totalCost[]';
        input7.placeholder = '00.0';
        input7.readOnly = true; // Make this field read-only
        input7.required = true;
        cell7.appendChild(input7);

        // Remove Button
        const cell8 = newRow.insertCell(7);
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-danger btn-sm';
        button.innerHTML = '<i class="bi bi-trash"></i>';
        button.onclick = function () {
            removeMedicineRow(button);
            calculateSubAmount();
        };
        cell8.appendChild(button);
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

<script>
    // Function to generate a random 6-digit integer
    function generateRandomSixDigitNumber() {
        return Math.floor(Math.random() * 90000000) + 10000000; // Range: 100000 to 999999
    }

    // Generate a random number when the page loads
    window.onload = function() {
        const randomNumber = generateRandomSixDigitNumber();
        document.getElementById('randomNumber').value = randomNumber;
    };
</script>
<script>
    // Hide the message after 3 seconds
    setTimeout(() => {
        const messageElement = document.getElementById('message');
        if (messageElement) {
            messageElement.style.display = 'none';
        }
    }, 1000);
</script>

</main>
<!-- main part end -->

<!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>