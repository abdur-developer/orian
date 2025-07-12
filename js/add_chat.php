<?php
header('Content-Type: application/json');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get the raw POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input
if (!isset($data['user_id']) || !isset($data['messages'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}
$userId = $data['user_id'];
$message = $data['messages'];
$sender = $data['type'];

require_once "../include/dbcon.php";

$stmt = $conn->prepare("INSERT INTO messages (user_id, message, sender) VALUES (?, ?, ?)");
$stmt->bind_param("isi", $userId, $message, $sender);
$stmt->execute();
$stmt->close();

// Respond with success
echo json_encode(['success' => true]);
?>