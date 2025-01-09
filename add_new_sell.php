 
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

<div class="container mt-5">
        <div class="d-flex justify-content-between">
        <h2 class="">Sell Medicines</h2>
            <div>
            <a href="sell_list.php" class="btn btn-success d-block my-2" role="button">
        View Sell List
        </a>
            </div>
        </div>

    <form id="sellMedicineForm">
    <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="customerName" class="form-label">Customer Name:</label>
                    <input type="text" class="form-control" id="customerName" required>
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

            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="purchaseDate" class="form-label">sell Date:</label>
                    <input type="date" class="form-control" id="purchaseDate" required value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
        </div>
        <!-- Medicine Table -->

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle" id="medicineSellTable">
                <thead class="table-success">
                    <tr>
                        <th scope="col">Medicine Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price per Unit</th>
                        <th scope="col">Total Cost</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="medicineName[]" placeholder="Enter name" required></td>
                        <td><input type="number" class="form-control quantity" name="quantity[]" placeholder="Enter quantity" min="1" required></td>
                        <td><input type="number" class="form-control price" name="price[]" placeholder="Enter price" min="0" required></td>
                        <td><input type="number" class="form-control total-cost" name="totalCost[]" readonly></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeMedicineRow(this)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary mb-3" onclick="addMedicineRow()">
            <i class="bi bi-plus-square"></i> Add Medicine
        </button>

        <!-- Payment Section -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="subAmount" class="form-label">Sub Total:</label>
                    <input type="number" class="form-control" id="subAmount" readonly>
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount:</label>
                    <input type="number" class="form-control" id="discount" placeholder="Enter discount" min="0" oninput="calculateTotal()">
                </div>
                <div class="mb-3">
                    <label for="payableAmount" class="form-label">Payable Amount:</label>
                    <input type="number" class="form-control" id="payableAmount" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="receivedAmount" class="form-label">Received Amount:</label>
                    <input type="number" class="form-control" id="receivedAmount" placeholder="Enter received amount" min="0" oninput="calculateDueAmount()">
                </div>
                <div class="mb-3">
                    <label for="dueAmount" class="form-label">Due Amount:</label>
                    <input type="number" class="form-control" id="dueAmount" readonly>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
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
    // Function to add a new row
    function addMedicineRow() {
        const table = document.getElementById('medicineSellTable').getElementsByTagName('tbody')[0];
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
        input2.className = 'form-control quantity';
        input2.name = 'quantity[]';
        input2.placeholder = 'Enter quantity';
        input2.min = '1';
        input2.required = true;
        input2.oninput = calculateRowTotal;
        cell2.appendChild(input2);

        // Price per Unit
        const cell3 = newRow.insertCell(2);
        const input3 = document.createElement('input');
        input3.type = 'number';
        input3.className = 'form-control price';
        input3.name = 'price[]';
        input3.placeholder = 'Enter price';
        input3.min = '0';
        input3.required = true;
        input3.oninput = calculateRowTotal;
        cell3.appendChild(input3);

        // Total Cost
        const cell4 = newRow.insertCell(3);
        const input4 = document.createElement('input');
        input4.type = 'number';
        input4.className = 'form-control total-cost';
        input4.name = 'totalCost[]';
        input4.readOnly = true;
        cell4.appendChild(input4);

        // Remove Button
        const cell5 = newRow.insertCell(4);
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-danger btn-sm';
        button.innerHTML = '<i class="bi bi-trash"></i>';
        button.onclick = function () {
            removeMedicineRow(button);
        };
        cell5.appendChild(button);
    }

    // Function to remove a row
    function removeMedicineRow(button) {
        const row = button.closest('tr');
        row.remove();
        calculateSubTotal();
    }

    // Calculate total cost for a row
    function calculateRowTotal() {
        const row = this.closest('tr');
        const quantity = row.querySelector('.quantity').value || 0;
        const price = row.querySelector('.price').value || 0;
        const totalCost = row.querySelector('.total-cost');
        totalCost.value = quantity * price;
        calculateSubTotal();
    }

    // Calculate sub total
    function calculateSubTotal() {
        let subTotal = 0;
        const totalCosts = document.querySelectorAll('.total-cost');
        totalCosts.forEach(input => {
            subTotal += parseFloat(input.value) || 0;
        });
        document.getElementById('subAmount').value = subTotal;
        calculateTotal();
    }

    // Calculate total after discount
    function calculateTotal() {
        const subTotal = parseFloat(document.getElementById('subAmount').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const payableAmount = subTotal - discount;
        document.getElementById('payableAmount').value = payableAmount;
        calculateDueAmount();
    }

    // Calculate due amount
    function calculateDueAmount() {
        const payableAmount = parseFloat(document.getElementById('payableAmount').value) || 0;
        const receivedAmount = parseFloat(document.getElementById('receivedAmount').value) || 0;
        const dueAmount = payableAmount - receivedAmount;
        document.getElementById('dueAmount').value = dueAmount >= 0 ? dueAmount : 0;
    }
</script>


</main>
     <!-- main part end -->


        <!-- footer part start  -->
<?php include("./pages/common_pages/footer.php");?>



    
   
                