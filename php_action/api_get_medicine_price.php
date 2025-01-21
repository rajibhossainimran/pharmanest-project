<?php
include_once "../config/config.php";

if (isset($_GET['medicine_id'])) {
    $medicine_id = intval($_GET['medicine_id']);

    $query = "SELECT sell_price, quantity FROM medicine_stock WHERE medicine_id = ?";
    $stmt = $db->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $medicine_id);
        $stmt->execute();
        
        $stmt->bind_result($sell_price, $quantity);

        if ($stmt->fetch()) {
            echo json_encode([
                'sell_price' => $sell_price,
                'quantity' => $quantity
            ]);
        } else {
            echo json_encode(['error' => 'This medicine do not purchase!']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare the query']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
