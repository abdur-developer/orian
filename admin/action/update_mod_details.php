<?php
include_once "../../include/dbcon.php";

// Set JSON header right at the start
header('Content-Type: application/json');

// Configuration
$upload_dir = '../../secure_storage/videos/';
$max_file_size = 500 * 1024 * 1024; // 500MB
$allowed_types = [
    'video/mp4' => 'mp4',
    'video/webm' => 'webm',
    'video/ogg' => 'ogg',
    'video/quicktime' => 'mov'
];

function jsonResponse($success, $message, $data = []) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Invalid request method');
}

// Validate required fields
$id = isset($_POST['id']) ? intval($_POST['id']) : null;
$title = trim($_POST['title'] ?? '');
$module_id = isset($_POST['module_id']) ? intval($_POST['module_id']) : 0;
$is_free = isset($_POST['is_free']) ? intval($_POST['is_free']) : 0;
$time = trim($_POST['time'] ?? '');

if (empty($title)) {
    jsonResponse(false, 'Title is required');
}

try {
    // Get current video if exists
    $current_video = null;
    if ($id) {
        $stmt = $conn->prepare("SELECT video FROM module_details WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $current_video = $result->fetch_assoc()['video'] ?? null;
        $stmt->close();
    }

    // Handle video upload/removal
    $video_name = $current_video;
    $remove_video = isset($_POST['remove_video']) && $_POST['remove_video'] == 'on';

    if ($remove_video && $current_video) {
        // Remove existing video
        if (file_exists($upload_dir . $current_video)) {
            unlink($upload_dir . $current_video);
        }
        $video_name = null;
    } elseif (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        // Validate upload directory
        $upload_dir = rtrim($upload_dir, '/') . '/';
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                jsonResponse(false, 'Failed to create upload directory');
            }
        }

        // Validate file
        if ($_FILES['video']['size'] > $max_file_size) {
            jsonResponse(false, 'File too large (max ' . formatBytes($max_file_size) . ')');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['video']['tmp_name']);
        finfo_close($finfo);

        if (!array_key_exists($mime_type, $allowed_types)) {
            jsonResponse(false, 'Invalid video format. Allowed: ' . implode(', ', array_keys($allowed_types)));
        }

        // Generate unique filename
        $extension = $allowed_types[$mime_type];
        $filename = 'vid_' . uniqid() . '.' . $extension;
        $target_path = $upload_dir . $filename;

        // Move uploaded file
        if (!move_uploaded_file($_FILES['video']['tmp_name'], $target_path)) {
            jsonResponse(false, 'Failed to save video');
        }

        // Delete old video if exists
        if ($current_video && file_exists($upload_dir . $current_video)) {
            unlink($upload_dir . $current_video);
        }

        $video_name = $filename;
    }

    // Prepare SQL based on whether we're updating or inserting
    if ($id) {
        $sql = "UPDATE module_details SET title = ?, time = ?, video = ?, is_free = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $title, $time, $video_name, $is_free, $id);
    } else {
        $sql = "INSERT INTO module_details (module_id, title, time, video, is_free) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issii", $module_id, $title, $time, $video_name, $is_free);
    }

    if (!$stmt->execute()) {
        throw new Exception("Database error: " . $stmt->error);
    }

    $new_id = $id ?: $conn->insert_id;
    $stmt->close();

    jsonResponse(true, 'Operation completed successfully', [
        'id' => $new_id,
        'redirect' => "../../admin/?q=module_details&id=" . encryptSt($new_id)
    ]);

} catch (Exception $e) {
    jsonResponse(false, $e->getMessage());
}