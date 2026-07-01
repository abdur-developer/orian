<?php
header('Content-Type: application/json');
include_once "../../../include/dbcon.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $itemId = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM chat_suggestions WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }
    $stmt->close();
    $conn->close();
    exit;
}
$sql = "SELECT id, message_text FROM chat_suggestions ORDER BY id DESC";
$result = $conn->query($sql);

$suggestions = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = ['id' => $row['id'],'message_text' => $row['message_text']];
    }
}

echo json_encode($suggestions);

$conn->close();
?>