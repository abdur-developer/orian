<?php
require_once 'key_manager.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');

try {
    if (!isset($_GET['video'])) {
        throw new Exception('Video parameter is required', 400);
    }

    $video = basename($_GET['video']);

    if (!preg_match('/^[a-zA-Z0-9_\-\.]+\.(mp4|webm)$/', $video)) {
        throw new Exception('Invalid video filename format', 400);
    }

    $videoPath = __DIR__ . '/../secure_storage/videos/' . $video;
    if (!file_exists($videoPath)) {
        // throw new Exception('Video file not found', 404);
        throw new Exception($videoPath, 404);
    }

    $key = KeyManager::getCurrentKey();
    $expires = time() + 3600; // 1 hour
    $tokenData = [
        'video' => $video,
        'expires' => $expires
    ];
    $token = hash_hmac('sha256', json_encode($tokenData, JSON_UNESCAPED_SLASHES), $key);

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];

    session_start();
    $_SESSION['token'] = $token; // Store token in session to prevent reuse
    $_SESSION['count'] = base64_encode(0 ^ 12345);
    session_write_close();

    echo json_encode([
        'status' => 'success',
        'video' => $video,
        'token' => $token,
        'expires' => $expires,
        'url' => "{$scheme}://{$host}/orian/video/secure_video.php?" . http_build_query([
            'video' => $video,
            'token' => $token,
            'expires' => $expires
        ]),
        'refresh_url' => "{$scheme}://{$host}/orian/video/generate_token.php?" . http_build_query([
            'video' => $video,
            'refresh' => true
        ])
    ], JSON_UNESCAPED_SLASHES);

} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'code' => $e->getCode()
    ]);
}
