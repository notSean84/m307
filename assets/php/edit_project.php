<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $projectId = intval($_GET['id']); // Sicherheitsmaßnahme gegen SQL-Injection
    $projectName = $conn->real_escape_string($_POST['projectName']);
    $startDate = $conn->real_escape_string($_POST['startDate']);
    $endDate = $conn->real_escape_string($_POST['endDate']);

    $sql = "UPDATE project SET name = ?, start_date = ?, end_date = ? WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $projectName, $startDate, $endDate, $projectId);

    if ($stmt->execute()) {
        header("Location: /index.php"); // Erfolgreiches Update → Zur Startseite weiterleiten
        exit();
    } else {
        echo "Fehler beim Aktualisieren: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Ungültige Anfrage.";
}
?>
