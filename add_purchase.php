 
<?php include('check_user.php'); ?>
<!-- database  -->
 <?php require_once './config/config.php';?>
<!-- header part  -->
 <?php  include("./pages/common_pages/header.php");?>



        <!--navber and sideber part start-->
 <?php include("./pages/common_pages/navber.php");?>
 <?php include("./pages/common_pages/sidebar.php");?>
<?php 
$message_delete = isset($_GET['message_delete']) ? $_GET['message_delete'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;


?>
        
 

<main  class="app-main">
<div class="container mt-2 mb-5">
    <h2>Add Purchase</h2>
    <form>
        <!-- Supplier Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="supplierName" class="form-label">Supplier Name:</label>
                    <input type="text" class="form-control" id="supplierName" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="invoice" class="form-label">Invoice Number:</label>
                    <input type="text" class="form-control" id="randomNumber" readonly>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="company" class="form-label">Company Name:</label>
                    <input type="text" class="form-control" id="company" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="purchaseDate" class="form-label">Purchase Date:</label>
                    <input type="date" class="form-control" id="purchaseDate" required value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
        </div>

      <!-- Medicine Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="medicineTable">
            <thead class="table-success">
                <tr>
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
                    <td><input type="text" class="form-control" name="medicineName[]" placeholder="Enter name" required></td>
                    <td><input type="number" class="form-control" name="quantity[]" placeholder="Enter quantity" required></td>
                    <td><input type="number" class="form-control" name="supplierPrice[]" placeholder="Supplier price" required></td>
                    <td><input type="number" class="form-control" name="sellPrice[]" placeholder="Sell price" required></td>
                    <td><input type="date" class="form-control" name="expiryDate[]" required></td>
                    <td><input type="number" class="form-control" name="totalCost[]" placeholder="Total cost" required></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeMedicineRow(this)">
                            <i class="bi bi-trash"></i> Remove
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
                    <input type="number" class="form-control" id="subAmount" required>
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" class="form-control" id="discount" required>
                </div>
                <div class="mb-3">
                    <label for="payableAmount" class="form-label">Payable Amount:</label>
                    <input type="number" class="form-control" id="payableAmount" required>
                </div>
                <div class="mb-3">
                    <label for="receivedAmount" class="form-label">Received Amount:</label>
                    <input type="number" class="form-control" id="receivedAmount" required>
                </div>
                <div class="mb-3">
                    <label for="dueAmount" class="form-label">Due Amount:</label>
                    <input type="number" class="form-control" id="dueAmount" required>
                </div>
                <div class="mb-3">
                    <label for="paymentStatus" class="form-label">Payment Status:</label>
                    <select class="form-control" id="paymentStatus">
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
            <button type="submit" class="btn btn-success">Submit</button>
            </div>
            <div class="col-4"></div>
        
        </div>
    </form>
</div>
</main>

<script>
        // Function to generate a random 6-digit integer
        function generateRandomSixDigitNumber() {
            return Math.floor(Math.random() * 900000) + 100000; // Range: 100000 to 999999
        }

        // Generate a random number when the page loads
        window.onload = function() {
            const randomNumber = generateRandomSixDigitNumber();
            document.getElementById('randomNumber').value = randomNumber;
        };

    </script>
<script>
    // Function to add a new row to the medicine table
function addMedicineRow() {
    const table = document.getElementById('medicineTable').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();

    // Medicine Name
    const cell1 = newRow.insertCell(0);
    const input1 = document.createElement('input');
    input1.type = 'text';
    input1.className = 'form-control';
    input1.name = 'medicineName[]';
    input1.placeholder = 'Enter name';
    input1.required = true;
    cell1.appendChild(input1);

    // Quantity
    const cell2 = newRow.insertCell(1);
    const input2 = document.createElement('input');
    input2.type = 'number';
    input2.className = 'form-control';
    input2.name = 'quantity[]';
    input2.placeholder = 'Enter quantity';
    input2.required = true;
    cell2.appendChild(input2);

    // Supplier Price
    const cell3 = newRow.insertCell(2);
    const input3 = document.createElement('input');
    input3.type = 'number';
    input3.className = 'form-control';
    input3.name = 'supplierPrice[]';
    input3.placeholder = 'Supplier price';
    input3.required = true;
    cell3.appendChild(input3);

    // Sell Price
    const cell4 = newRow.insertCell(3);
    const input4 = document.createElement('input');
    input4.type = 'number';
    input4.className = 'form-control';
    input4.name = 'sellPrice[]';
    input4.placeholder = 'Sell price';
    input4.required = true;
    cell4.appendChild(input4);

    // Expiry Date
    const cell5 = newRow.insertCell(4);
    const input5 = document.createElement('input');
    input5.type = 'date';
    input5.className = 'form-control';
    input5.name = 'expiryDate[]';
    input5.required = true;
    cell5.appendChild(input5);

    // Total Cost
    const cell6 = newRow.insertCell(5);
    const input6 = document.createElement('input');
    input6.type = 'number';
    input6.className = 'form-control';
    input6.name = 'totalCost[]';
    input6.placeholder = 'Total cost';
    input6.required = true;
    cell6.appendChild(input6);

    // Remove Button
    const cell7 = newRow.insertCell(6);
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'btn btn-danger btn-sm';
    button.innerHTML = '<i class="bi bi-trash"></i> Remove';
    button.onclick = function () {
        removeMedicineRow(button);
    };
    cell7.appendChild(button);
}

// Function to remove a row from the medicine table
function removeMedicineRow(button) {
    const row = button.closest('tr'); // Find the closest table row to the clicked button
    row.remove(); // Remove the row
}


</script>
    </main>
     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                