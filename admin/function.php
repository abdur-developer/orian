<?php
function uploadImage(array $img_file, string $target_dir = '../upload/', string $prefix = 'img_'): array{
    // Normalize directory path
    $target_dir = rtrim($target_dir, '/') . '/';

    // Resolve absolute path
    $resolved_path = realpath($target_dir);

    // Attempt to create directory if it doesn't exist
    if (!$resolved_path) {
        if (!mkdir($target_dir, 0755, true)) {
            return ['target_file' => '','success' => false,'message' => 'Failed to create upload directory.'];
        }
        $resolved_path = realpath($target_dir);
    }

    // Check if the directory is writable
    if (!is_writable($resolved_path)) {
        return ['target_file' => '','success' => false,'message' => 'Upload directory is not writable.'];
    }

    // Validate file input
    if (
        !isset($img_file['error'], $img_file['tmp_name']) ||
        !is_uploaded_file($img_file['tmp_name']) ||
        is_array($img_file['error'])
    ) {
        return ['target_file' => '','success' => false,'message' => 'Invalid file upload.'];
    }

    // Handle upload errors
    switch ($img_file['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return ['target_file' => '','success' => false,'message' => 'File too large (max 5MB).'];
        case UPLOAD_ERR_NO_FILE:
            return ['target_file' => '','success' => false,'message' => 'No file uploaded.'];
        default:
            return ['target_file' => '','success' => false,'message' => 'Unknown upload error.'];
    }

    // Validate MIME type
    $allowed_mimes = [
        'image/jpeg' => 'jpg',
        'image/png'=> 'png',
        'image/gif'=> 'gif',
        'image/svg+xml' => 'svg',
        'image/webp' => 'webp'
    ];

    $file_info = getimagesize($img_file['tmp_name']);
    if (!$file_info || !array_key_exists($file_info['mime'], $allowed_mimes)) {
        return ['target_file' => '','success' => false,'message' => 'Invalid image file.'];
    }

    // Generate unique filename
    $extension = $allowed_mimes[$file_info['mime']];
    $unique_name = $prefix . uniqid('', true) . '.' . $extension;
    $target_file = $resolved_path . '/' . $unique_name;

    // Move uploaded file
    if (move_uploaded_file($img_file['tmp_name'], $target_file)) {
        // Optimize image size if JPEG or PNG
        switch ($file_info['mime']) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($target_file);
                imagejpeg($image, $target_file, 75); // 0–100 (lower = smaller, 75 is a good balance)
                imagedestroy($image);
                break;

            case 'image/png':
                $image = imagecreatefrompng($target_file);
                imagepng($image, $target_file, 6); // 0–9 (higher = smaller file, but slower)
                imagedestroy($image);
                break;
        }

        return ['target_file' => $target_dir . $unique_name,'success' => true,'message' => 'Upload successful (optimized).'];
    }

    return ['target_file' => '','success' => false,'message' => 'Failed to save uploaded file.'];
}
//////////////