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
    <div class="container mt-2 mb-5">
    <h1>Medicine List</h1>
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>SL</th>
                <th>Medicine Name</th>
                <th>Image</th>
                <th>Company</th>
                <th>Type</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $count++;
                    echo "<tr>
                        <td>$count</td>
                        <td>{$row['m_name']}</td>
                        <td><img src='{$row['medicine_image']}' alt='Medicine Image' class='img-thumbnail' style='max-width: 100px;'></td>
                        <td>{$row['manufacturer']}</td>
                        <td>{$row['m_type']}</td>
                        <td>{$row['supplier']}</td>
                        <td>{$row['status']}</td>
                                                
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
</main>


<?php include("./pages/common_pages/footer.php"); ?>
<?php
$db->close();
?>
