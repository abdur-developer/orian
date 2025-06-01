<?php
require_once 'key_manager.php';

// Enable output buffering
ob_start();

try {
    // Validate all parameters
    if (!isset($_GET['video'], $_GET['token'], $_GET['expires'])) {
        throw new Exception('Missing parameters', 400);
    }

    // Sanitize inputs
    $video = basename($_GET['video']);
    $token = $_GET['token'];
    session_start();
    if(!isset($_SESSION['token']) || !isset($_SESSION['count'])) {
        throw new Exception('Token not found', 403);
    }
    if ($_SESSION['token'] !== $token) {
        throw new Exception('Invalid token', 403);
    }
    if (!isset($_SERVER['HTTP_RANGE'])) {
        $count = (base64_decode($_SESSION['count']) ^ 12345);
        if($count > 0) {
            throw new Exception('Invalid request , refresh the page and try again', 403);
        }else {
            $count++;
            $_SESSION['count'] = base64_encode($count ^ 12345); // Reset count
        }
        session_write_close();
    }

    $expires = (int)$_GET['expires'];

    // Verify token
    if (!KeyManager::validateToken($token, $video, $expires)) {
        throw new Exception('Invalid security token', 403);
    }

    // Check expiration
    if (time() > $expires) {
        throw new Exception('Token expired', 403);
    }

    // Define video path
    $videoDir = __DIR__ . '/../secure_storage/videos/';
    $filePath = realpath($videoDir . $video);

    // Security checks
    if (!$filePath || strpos($filePath, realpath($videoDir)) !== 0) {
        throw new Exception('Invalid file path', 403);
    }

    if (!file_exists($filePath)) {
        throw new Exception('Video file not found', 404);
    }

    // Get file info
    $fileSize = filesize($filePath);
    $mimeType = mime_content_type($filePath);
    $lastModified = filemtime($filePath);

    // Handle caching (304 Not Modified)
    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) &&
        strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastModified) {
        header('HTTP/1.1 304 Not Modified');
        exit;
    }

    // Set headers
    header('Content-Type: ' . $mimeType);
    header('Content-Length: ' . $fileSize);
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModified) . ' GMT');
    header('Accept-Ranges: bytes');
    header('Cache-Control: private, max-age=3600');

    // Use X-Sendfile if available
    if (isset($_SERVER['HTTP_X_SENDFILE_TYPE'])) {
        header('X-Sendfile: ' . $filePath);
        exit;
    }

    // Handle range requests (for seeking)
    if (isset($_SERVER['HTTP_RANGE'])) {
        streamRange($filePath, $fileSize);
    } else {
        streamFile($filePath);
    }

} catch (Exception $e) {
    ob_end_clean();
    http_response_code($e->getCode() ?: 500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => $e->getMessage(),
        'status' => 'error'
    ]);
    exit;
}

function streamRange($filePath, $fileSize) {
    $range = $_SERVER['HTTP_RANGE'];
    $parts = explode('=', $range, 2);
    $unit = $parts[0];
    $offsets = explode('-', $parts[1], 2);

    $start = (int)$offsets[0];
    $end = isset($offsets[1]) && is_numeric($offsets[1]) ? (int)$offsets[1] : $fileSize - 1;

    if ($start >= $fileSize || $end >= $fileSize) {
        header('HTTP/1.1 416 Requested Range Not Satisfiable');
        header('Content-Range: bytes */' . $fileSize);
        exit;
    }

    header('HTTP/1.1 206 Partial Content');
    header('Content-Range: bytes ' . $start . '-' . $end . '/' . $fileSize);
    header('Content-Length: ' . ($end - $start + 1));

    $bufferSize = 8192; // 8KB chunks
    $handle = fopen($filePath, 'rb');
    fseek($handle, $start);

    $remaining = $end - $start + 1;
    while ($remaining > 0 && !feof($handle)) {
        $chunk = min($bufferSize, $remaining);
        echo fread($handle, $chunk);
        flush();
        $remaining -= $chunk;
    }
    fclose($handle);
}

function streamFile($filePath) {
    $bufferSize = 8192; // 8KB chunks
    $handle = fopen($filePath, 'rb');

    while (!feof($handle)) {
        echo fread($handle, $bufferSize);
        flush();
    }
    fclose($handle);
}

ob_end_flush();
?>
