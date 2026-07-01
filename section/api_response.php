<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

try {
    require_once "../include/dbcon.php";

    $input = json_decode(file_get_contents('php://input'), true);
    $message = $input['message'] ?? '';
    $messageId = $input['message_id'] ?? null;

    if ($messageId) {
        // Get response for specific suggestion
        $stmt = $conn->prepare("SELECT response_text FROM chat_suggestions WHERE id = ?");
        $stmt->bind_param("i", $messageId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        $response = $result['response_text'] ?? "Thank you for your message. How can I help you further?";
        $nextParentId = $messageId; // Next suggestions will be children of this message
    } else {
        // Handle free-form message
        $response = "Thank you for your message. Here are some options that might help:";
        $nextParentId = null; // Show initial suggestions
    }

    echo json_encode([
        'success' => true,
        'response' => $response,
        'next_suggestions_parent_id' => $nextParentId
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => "Connection failed: " . $e->getMessage()
    ]);
}
?>
