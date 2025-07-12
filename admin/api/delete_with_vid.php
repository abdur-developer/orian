<?php
header('Content-Type: application/json');
include_once "../../include/dbcon.php";

// Verify user authentication/authorization here
// session_start();
// if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
//     http_response_code(403);
//     echo json_encode(['success' => false, 'message' => 'Unauthorized']);
//     exit;
// }

$input = json_decode(file_get_contents('php://input'), true);
$id = isset($input['id']) ? intval($input['id']) : (isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : 0));

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid suggestion ID']);
    exit;
}

try {
    // Begin transaction
    $conn->begin_transaction();

    // Get video filename
    $stmt = $conn->prepare("SELECT video FROM module_details WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($video);
    $stmt->fetch();
    $stmt->close();

    // Delete file if exists
    if ($video) {
        $filePath = realpath("../../secure_storage/videos/" . basename($video));
        // Verify the file is within the intended directory
        if ($filePath && strpos($filePath, realpath("../../secure_storage/videos/")) === 0) {
            if (file_exists($filePath)) {
                if (!unlink($filePath)) {
                    throw new Exception("Failed to delete video file");
                }
            }
        }
    }

    // Delete database record
    $stmt = $conn->prepare("DELETE FROM module_details WHERE id = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        throw new Exception("Database deletion failed");
    }
    $stmt->close();

    // Commit transaction
    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Suggestion deleted successfully']);
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Deletion failed: ' . $e->getMessage()]);
} finally {
    $conn->close();
}
?>