<?php include('check_user.php'); ?>
<!-- database  -->
<?php require_once './config/config.php'; ?>
<!-- header part  -->
<?php include("./pages/common_pages/header.php"); ?>

<!--navber and sideber part start-->
<?php include("./pages/common_pages/navber.php"); ?>
<?php include("./pages/common_pages/sidebar.php"); ?>

<main class="app-main">
    <div class="container mt-2 mb-5">
        <h2>Add Medicine</h2>
        <form action="process_add_medicine.php" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="medicineName" class="form-label">Medicine Name:</label>
                        <input type="text" class="form-control" id="medicineName" name="medicine_name" required>
                        <!-- medicine name suggestion box -->
                        <div id="autocompleteList" class="autocomplete-list"></div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                        <label for="shelfNo" class="form-label">Shelf No:</label>
                        <input type="text" class="form-control" id="shelfNo" name="shelf_no" required>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="manufacturer" class="form-label">Manufacturer:</label>
                        <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="medicineType" class="form-label">Medicine Type:</label>
                        <select class="form-control" id="medicineType" name="medicine_status">
                        <option value="">--Select medicine type--</option>
                        <?php
                        
                            $manufaclist = $db->query("SELECT * FROM medicine_type");
                            while (list($_bid, $_bname, $_baddress, $_bcontact) = $manufaclist->fetch_row()) {
                                echo "<option value='$_bid'>$_bname</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="genericName" class="form-label">Generic Name:</label>
                        <input type="text" class="form-control" id="genericName" name="generic_name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="supplierName" class="form-label">Supplier Name:</label>
                        <select class="form-control" id="medicineSupplier" name="medicine_supplier">
                        <option value="">--Select supplier--</option>
                        <?php
                        
                            $manufaclist = $db->query("SELECT * FROM supplier_add");
                            while (list($_bid, $_bname, $_baddress, $_bcontact) = $manufaclist->fetch_row()) {
                                echo "<option value='$_bid'>$_bname</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="medicineStatus" class="form-label">Medicine Status:</label>
                        <select class="form-control" id="medicineStatus" name="medicine_status">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="medicineImage" class="form-label">Upload Image:</label>
                            <input type="file" class="form-control" id="medicineImage" name="medicine_image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center border rounded p-3" style="min-height: 200px;">
                            <p class="text-muted" id="previewText">No image selected</p>
                            <img id="imagePreview" src="#" alt="Preview" class="img-fluid d-none" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
                  </div>
            </div>

            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 text-center">
                    <button type="submit" class="btn btn-success">Add Medicine</button>
                </div>
                <div class="col-4"></div>
            </div>
        </form>
    </div>
</main>
<!-- image display in side box code  -->
<script>
    const medicineImage = document.getElementById('medicineImage');
    const imagePreview = document.getElementById('imagePreview');
    const previewText = document.getElementById('previewText');

    medicineImage.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            previewText.classList.add('d-none');
            imagePreview.classList.remove('d-none');

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('d-none');
            previewText.classList.remove('d-none');
        }
    });
</script>

<!-- company or manufacturer name suggestion code js  -->
<script>
    let medicines = [];

    // Fetch JSON data
    fetch("json_data/another.json")
      .then(response => response.json())
      .then(data => {
        medicines = data; // Load the medicines data
      })
      .catch(error => console.error("Error loading JSON:", error));

    const brandInput = document.getElementById("medicineName");
    const genericInput = document.getElementById("genericName");
    const manufacturerInput = document.getElementById("manufacturer");
    const autocompleteList = document.getElementById("autocompleteList");

    brandInput.addEventListener("input", function () {
      const query = brandInput.value.toLowerCase();
      autocompleteList.innerHTML = "";

      if (query) {
        const filteredMedicines = medicines.filter(medicine =>
          medicine.brand.toLowerCase().includes(query)
        );

        filteredMedicines.forEach(medicine => {
          const item = document.createElement("div");
          item.textContent = medicine.brand;
          item.addEventListener("click", function () {
            // Update input fields with selected data
            brandInput.value = medicine.brand;
            genericInput.value = medicine.generic;
            manufacturerInput.value = medicine.manufacturer;
            autocompleteList.innerHTML = "";
          });
          autocompleteList.appendChild(item);
        });
      }
    });

    document.addEventListener("click", function (e) {
      if (!autocompleteList.contains(e.target) && e.target !== brandInput) {
        autocompleteList.innerHTML = "";
      }
    });
  </script>
<?php include("./pages/common_pages/footer.php"); ?>