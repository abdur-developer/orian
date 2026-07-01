<?php
    header('Content-Type: application/json');
    include_once "../../include/dbcon.php";

    $input = json_decode(file_get_contents('php://input'), true);
    $id = isset($input['id']) ? intval($input['id']) : (isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : 0));
    $table = isset($input['table']) ? $input['table'] : "";

    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid suggestion ID']);
        exit;
    }
    if ($table == "" || $table == null) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid table name']);
        exit;
    }

    // Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Suggestion deleted']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to delete suggestion']);
    }

    $stmt->close();
    $conn->close();
?>