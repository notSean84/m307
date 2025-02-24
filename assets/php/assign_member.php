<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Werte aus dem Formular abrufen und validieren
    $project_id = isset($_POST['projectSelect']) ? intval($_POST['projectSelect']) : 0;
    $teammember_id = isset($_POST['userSelect']) ? intval($_POST['userSelect']) : 0;
    $role_name = isset($_POST['roleName']) ? trim($_POST['roleName']) : '';

    if ($project_id > 0 && $teammember_id > 0 && !empty($role_name)) {
        // SQL-Statement vorbereiten
        $sql = "INSERT INTO role (name, project_project_id, teammember_teammember_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sii", $role_name, $project_id, $teammember_id);
            
            if ($stmt->execute()) {
                echo "Erfolgreich zugewiesen!";
                header("Location: /index.php");
            } else {
                echo "Fehler: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Fehler bei der Vorbereitung des Statements.";
        }
    } else {
        echo "Bitte alle Felder ausfüllen.";
    }
}
$conn->close();
?>

