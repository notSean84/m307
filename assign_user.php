<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$conn = new mysqli('127.0.0.1:3306', 'root', '', 'm307');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO role (name, project_project_id, teammember_teammember_id) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $data['role'], $data['project_id'], $data['user_id']);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>