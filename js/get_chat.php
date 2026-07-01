<?php
header("Content-Type: application/json");
require_once "../include/dbcon.php"; // DB connection here

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$user_id = $input['user_id'] ?? '';
$last_id = $input['last_id'] ?? 0;

$sql = "SELECT * FROM messages WHERE user_id = ? AND id > ? ORDER BY id ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $last_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
