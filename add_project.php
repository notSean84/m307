<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$conn = new mysqli('127.0.0.1:3306', 'root', '', 'm307');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO project (name, start_date, end_date) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $data['name'], $data['start_date'], $data['end_date']);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>