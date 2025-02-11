<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['userFirstName'];
    $lastName = $_POST['userLastName'];
    $lehrgang = $_POST['userLehrgang'];

    $sql = "INSERT INTO teammember (first_name, last_name, lehrgang) VALUES ('$firstName', '$lastName', '$lehrgang')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.html"); // Weiterleitung zurück zur Startseite
        exit();
    } else {
        echo "Fehler: " . $conn->error;
    }    
    $conn->close();
}