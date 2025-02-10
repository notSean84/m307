<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$conn = new mysqli('127.0.0.1:3306', 'root', '', 'm307');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO teammember (first_name, last_name, lehrgang) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $data['first_name'], $data['last_name'], $data['lehrgang']);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>