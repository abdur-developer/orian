<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

try {
    require_once "../include/dbcon.php";    
    
    $parent_id = isset($_GET['parent_id']) ? (int)$_GET['parent_id'] : null;

    if ($parent_id != null && $parent_id > 0 && is_numeric($parent_id) && empty($parent_id) == false) {
        $stmt = $conn->prepare("SELECT id, message_text FROM chat_suggestions WHERE parent_id = ?");
        $stmt->bind_param("i", $parent_id);
    } else {
        $stmt = $conn->prepare("SELECT id, message_text FROM chat_suggestions WHERE is_initial = 1");
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row;
    }

    echo json_encode([
        'success' => true,
        'suggestions' => $suggestions
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => "Connection failed: " . $e->getMessage()
    ]);
}
?>
