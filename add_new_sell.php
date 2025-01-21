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
        <h2 class="">Add New sell</h2>
            <div>
            <a href="sell_list.php" class="btn btn-success d-block my-2" role="button">
        View sell Lists
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
    <form method="POST" id="purchaseBtnSubmit" action="./php_action/create_new_sell.php" enctype="multipart/form-data">
        <!-- Supplier Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="supplierName" class="form-label">Customer Name:</label>
                    <select class="form-control" id="medicineSupplier" name="medicine_supplier">
                        <option value="0">Customer</option>
                        <?php
                            $supplierclist = $db->query("SELECT * FROM customer");
                            while (list($_id, $_sname) = $supplierclist->fetch_row()) {
                                echo "<option value='$_id'>$_sname</option>";
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
                    <label for="purchaseDate" class="form-label">Sells Date:</label>
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
                        <th scope="col">Medicine Name</th>
                        <th scope="col">Available Qtn</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price (pcs)</th>
                        <th scope="col">Total Cost</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><select class="medicine-select form-control" name="medicineName[]" required>
                            <option value="" disabled selected>--Select medicine--</option>
                            <?php
                                $medicineList = $db->query("SELECT * FROM medicines");
                                while (list($_sid, $_sname) = $medicineList->fetch_row()) {
                                    echo "<option value='$_sid'>$_sname</option>";
                                }
                            ?>
                            </select></td>
                            <td><input type="number" class="form-control" name="availableQuantity[]" placeholder="0" required readonly></td>
                        <td><input type="number" class="form-control" name="quantity[]" placeholder="0" required></td>

                        <td><input type="number" class="price-field form-control" name="supplierPrice[]" placeholder="00.0" required></td>
                        
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
            <button type="submit" class="btn btn-success" name="sellBtn">Submit</button>

            </div>
            <div class="col-4"></div>
        </div>
    </form>
</div>
</main>

<!-- jquery downloaded  -->
 <script src="./bootstrap/jquery/jquery-3.7.1.min.js
 "></script>


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
    fetch('php_action/api_medicines.php')
        .then((response) => response.json())
        .then((data) => {
            data.forEach((medicine) => {
                const option = document.createElement('option');
                option.value = medicine.id;
                option.textContent = medicine.m_name;
                select1.appendChild(option);
            });
        })
        .catch((error) => {
            console.error('Error fetching medicines:', error);
            alert('Failed to load medicines. Please try again.');
        });
    cell1.appendChild(select1);

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

<script>
    // Function to generate a random 6-digit integer
    function generateRandomSixDigitNumber() {
        return Math.floor(Math.random() * 9000000000) + 1000000000; // Range: 100000 to 999999
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
<!-- fatching data jquery method fetch one -->
 <script>
document.addEventListener('change', (event) => {
    if (event.target.classList.contains('medicine-select')) {
        const select = event.target;
        const row = select.closest('tr');
        const medicineId = select.value;
        const priceField = row.querySelector('.price-field');
        const quantityField = row.querySelector('input[name="availableQuantity[]"]');

        if (medicineId) {
            fetch('./php_action/api_get_medicine_price.php?medicine_id=' + medicineId)
                .then((response) => response.json())
                .then((data) => {
                    if (data.sell_price !== undefined && data.quantity !== undefined) {
                        priceField.value = data.sell_price; // Set price
                        quantityField.value = data.quantity; // Set available quantity
                    } else if (data.error) {
                        alert(data.error);
                        priceField.value = '0.0'; // Fallback price
                        quantityField.value = '0'; // Fallback quantity
                    }
                })
                .catch((error) => {
                    console.error('Error fetching medicine details:', error);
                    alert('Failed to fetch data. Please try again.');
                    priceField.value = '0.0';
                    quantityField.value = '0';
                });
        } else {
            priceField.value = '';
            quantityField.value = '';
        }
    }
});

// Event delegation for input fields (quantity and price) to calculate total
document.addEventListener('input', (event) => {
    if (event.target.matches('.price-field, input[name="quantity[]"]')) {
        const row = event.target.closest('tr');
        calculateTotalCost(row);
        calculateSubAmount();
    }
});
 </script>

</main>
<!-- main part end -->

<!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>