<?php
header('Content-Type: application/json');
include_once "../../../include/dbcon.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $itemId = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM coupons WHERE id = ? LIMIT 1");
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
?>