<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $role_id = intval($_GET['id']);
    $role_name = trim($_POST['roleName']);

    if (!empty($role_name)) {
        $sql = "UPDATE role SET name = ? WHERE role_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $role_name, $role_id);

        if ($stmt->execute()) {
            header("Location:  /index.php?success=role_updated");
            exit();
        } else {
            echo "Fehler beim Aktualisieren der Rolle.";
        }
    } else {
        echo "Der Rollenname darf nicht leer sein.";
    }
} else {
    echo "Ungültige Anfrage.";
}

$conn->close();
?>
