<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id']; // ID aus URL holen
    $firstName = $_POST['userFirstName'];
    $lastName = $_POST['userLastName'];
    $lehrgang = $_POST['userLehrgang'];

    // Sicherstellen, dass die ID eine Zahl ist (SQL-Injection verhindern)
    if (!is_numeric($id)) {
        die("Ungültige ID!");
    }

    // SQL-Statement mit Prepared Statements (sicherer gegen SQL-Injections)
    $sql = "UPDATE teammember SET first_name = ?, last_name = ?, lehrgang = ? WHERE teammember_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $firstName, $lastName, $lehrgang, $id);

    if ($stmt->execute()) {
        header("Location: /index.php"); // Erfolgreich weiterleiten
        exit();
    } else {
        echo "Fehler: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Fehler: Ungültige Anfrage!";
}
?>
