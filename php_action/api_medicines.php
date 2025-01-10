<?php
header('Content-Type: application/json');
include_once "../config/config.php";

// Assuming $db is your database connection
$result = $db->query("SELECT id, m_name FROM medicines");
$suppliers = [];

while ($row = $result->fetch_assoc()) {
    $suppliers[] = [
        'id' => $row['id'],
        'm_name' => $row['m_name']
    ];
}

echo json_encode($suppliers);
?>
