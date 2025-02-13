<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sicherheitsmaßnahme

    $sql = "DELETE FROM teammember WHERE teammember_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: /index.php"); // Nach dem Löschen zurück zur Liste
        exit;
    } else {
        echo "Fehler beim Löschen.";
    }
} else {
    echo "Ungültige Anfrage.";
}
?>
