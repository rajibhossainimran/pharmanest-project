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
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Manufacturer</th>
                <th>Type</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['m_name']}</td>
                        <td>{$row['manufacturer']}</td>
                        <td>{$row['m_type']}</td>
                        <td>{$row['supplier']}</td>
                        <td>{$row['status']}</td>
                        <td><img src='{$row['medicine_image']}' alt='Medicine Image'></td>                        
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data found</td></tr>";
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
