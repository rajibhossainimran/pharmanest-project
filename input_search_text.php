<?php
// PHP array with company names (you can also fetch this from a database)
$companies = ["Google", "Microsoft", "Apple", "Amazon", "Facebook", "Tesla", "Twitter", "Adobe"];

// Handle form submission (optional)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedCompany = $_POST['company'];
    echo "<h3>You selected: $selectedCompany</h3>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searchable Company Dropdown</title>
    <style>
        input {
            width: 300px;
            padding: 8px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .company-list {
            margin-top: 10px;
        }
        .company-list div {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }
        .company-list div:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<h3>Select a Company</h3>

<form method="post">
    <!-- Input field for searching -->
    <input 
        type="text" 
        id="searchInput" 
        placeholder="Search company..." 
        autocomplete="off" 
        oninput="filterCompanies()"
    />
    
    <!-- Container for the search results (dynamically filled with JavaScript) -->
    <div id="companyList" class="company-list"></div>
    
    <!-- Hidden input for the selected company -->
    <input type="hidden" name="company" id="company" />
    
    <button type="submit">Submit</button>
</form>

<script>
    // PHP array of companies (could be dynamically loaded via AJAX)
    const companies = <?php echo json_encode($companies); ?>;

    // Function to filter companies based on search input
    function filterCompanies() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const companyList = document.getElementById("companyList");
        
        // Clear previous results
        companyList.innerHTML = "";

        // Filter companies based on the search input
        const filteredCompanies = companies.filter(company =>
            company.toLowerCase().includes(searchInput)
        );

        // Display filtered companies
        filteredCompanies.forEach(company => {
            const div = document.createElement("div");
            div.textContent = company;
            div.onclick = function() {
                // Set the selected company to the input field and hide the list
                document.getElementById("searchInput").value = company;
                document.getElementById("company").value = company;
                companyList.innerHTML = "";  // Clear the suggestions
            };
            companyList.appendChild(div);
        });
    }
</script>

</body>
</html>
