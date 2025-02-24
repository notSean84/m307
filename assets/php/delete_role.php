<?php
include "db.php";

if (isset($_GET['id'])) {
    $role_id = intval($_GET['id']);

    $sql = "DELETE FROM role WHERE role_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $role_id);

    if ($stmt->execute()) {
        header("Location: /index.php?success=role_deleted");
        exit();
    } else {
        echo "Fehler beim Löschen der Rolle.";
    }
} else {
    echo "Ungültige Anfrage.";
}

$conn->close();
?>
