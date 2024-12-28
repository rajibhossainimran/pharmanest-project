 
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
                    <label for="supplierName" class="form-label">Supplier Name</label>
                    <input type="text" class="form-control" id="supplierName" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="invoice" class="form-label">Invoice Number</label>
                    <input type="text" class="form-control" id="randomNumber" readonly>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="company" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="company" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="purchaseDate" class="form-label">Purchase Date</label>
                    <input type="date" class="form-control" id="purchaseDate" required value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
        </div>

        <!-- Medicine Table -->
        <table class="table table-bordered" id="medicineTable">
            <thead>
                <tr>
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" name="medicineName[]" required></td>
                    <td><input type="number" class="form-control" name="quantity[]" required></td>
                    <td><input type="number" class="form-control" name="totalCost[]" required></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeMedicineRow(this)">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button title="add medicine" type="button" class="btn btn-primary" onclick="addMedicineRow()"><i class="bi bi-plus-square"></i></button>

        <!-- Payment Information -->
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="subAmount" class="form-label">Sub Amount</label>
                    <input type="number" class="form-control" id="subAmount" required>
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="number" class="form-control" id="discount" required>
                </div>
                <div class="mb-3">
                    <label for="payableAmount" class="form-label">Payable Amount</label>
                    <input type="number" class="form-control" id="payableAmount" required>
                </div>
                <div class="mb-3">
                    <label for="receivedAmount" class="form-label">Received Amount</label>
                    <input type="number" class="form-control" id="receivedAmount" required>
                </div>
                <div class="mb-3">
                    <label for="dueAmount" class="form-label">Due Amount</label>
                    <input type="number" class="form-control" id="dueAmount" required>
                </div>
                <div class="mb-3">
                    <label for="paymentStatus" class="form-label">Payment Status</label>
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
        input1.required = true;
        cell1.appendChild(input1);

        // Quantity
        const cell2 = newRow.insertCell(1);
        const input2 = document.createElement('input');
        input2.type = 'number';
        input2.className = 'form-control';
        input2.required = true;
        cell2.appendChild(input2);

        // Total Cost
        const cell3 = newRow.insertCell(2);
        const input3 = document.createElement('input');
        input3.type = 'number';
        input3.className = 'form-control';
        input3.required = true;
        cell3.appendChild(input3);

        // Remove Button
        const cell4 = newRow.insertCell(3);
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-danger btn-sm';
        button.innerText = 'Remove';
        button.onclick = function() {
            removeMedicineRow(button);
        };
        cell4.appendChild(button);
    }

    // Function to remove a row from the medicine table
    function removeMedicineRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>
    </main>
     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                