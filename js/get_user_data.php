<?php
header("Content-Type: application/json");
require_once "../include/dbcon.php"; // DB connection

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$user_id = $input['user_id'] ?? '';

$sql = "SELECT m.*, u.name FROM (
            SELECT *, ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY id DESC) as rn FROM messages
        ) m 
        JOIN users u ON m.user_id = u.id 
        WHERE m.rn = 1 AND m.user_id = ? 
        ORDER BY m.id DESC 
        LIMIT 1"; // Extra safety with LIMIT

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'No message found']);
}
