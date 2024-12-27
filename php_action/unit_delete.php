<?php
// database connection 
include_once "../config/config.php";


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM unit WHERE id = ?";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirect with success message
            header("Location:../unit.php?message_delete=unit deleted successfully&type=success");
        } else {
            // Redirect with error message
            header("Location:../unit.php?message_delete=Failed to delete unit&type=error");
        }
        $stmt->close();
    } else {
        header("Location:../unit.php?message_delete=Error preparing query&type=error");
    }
    $conn->close();
} else {
    header("Location:../unit.php?message_delete=No ID provided&type=error");
}
exit;
?>
