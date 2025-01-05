<?php
// database connection 
include_once "../config/config.php";


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM medicines WHERE id = ?";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirect with success message
            header("Location:../medicine_list.php?message_delete=medicine deleted successfully&type=success");
        } else {
            // Redirect with error message
            header("Location:../medicine_list.php?message_delete=Failed to delete medicine&type=error");
        }
        $stmt->close();
    } else {
        header("Location:../medicine_list.php?message_delete=Error preparing query&type=error");
    }
    $conn->close();
} else {
    header("Location:../medicine_list.php?message_delete=No ID provided&type=error");
}
exit;
?>
