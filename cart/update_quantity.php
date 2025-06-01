<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['quantity']) && isset($data['item_id']) && is_numeric($data['quantity']) && $data['quantity'] > 0) {
    $quantity = intval($data['quantity']);
    $item_id = intval($data['item_id']);
    $sql = "UPDATE cart SET quantity = '$quantity' WHERE id = '$item_id'";
    
    require '../include/dbcon.php';
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
        exit;
    }
} else {
    echo json_encode(['success' => false]);
}
