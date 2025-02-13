<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectName = $_POST['projectName'];
    $startDate = $_POST['projectStartDate'];
    $endDate = $_POST['projectEndDate'];
// WICHTIG: AUTO INCREMENT MUSS BEI PROJECT UND ROLE NOCHT EINGESTELLT WERDEN
    $sql = "INSERT INTO project (name, start_date, end_date) VALUES ('$projectName', '$startDate', '$endDate')";
    if ($conn->query($sql) === TRUE) {
        header("Location: /index.php"); // Weiterleitung zurück zur Startseite
        exit();
    } else {
        echo "Fehler: " . $conn->error;
    }    
    $conn->close();
}