<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
//table, column, value, item_id
if (isset($data['table']) && isset($data['item_id'])) {
    $table = $data['table'];
    $column = $data['column'];
    $value = $data['value'];
    $item_id = $data['item_id'];
    $sql = "UPDATE $table SET $column = '$value' WHERE id = '$item_id'";

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
