<?php
header('Content-Type: application/json');

$conn = new mysqli('127.0.0.1:3306', 'root', '', 'm307');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM project");
$projects = [];

while($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

echo json_encode($projects);

$conn->close();
?>