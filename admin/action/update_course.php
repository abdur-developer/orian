<?php
include_once "../../include/dbcon.php";
include_once "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=course&error=Invalid+request');
    exit();
}

// Get form data
$id = $_POST['id'];
$title = trim($_POST['title']);
$provider = trim($_POST['provider']);
$instructor = trim($_POST['instructor']);
$description = trim($_POST['description']); // Short description
$overview = $_POST['overview']; // Quill HTML input
$ki_thakbe = json_encode($_POST['ki_thakbe'] ?? []);
$price = floatval($_POST['price']);
$rating = floatval($_POST['rating']);
$users = intval($_POST['users']);
$status = intval($_POST['status']);
$badge = trim($_POST['badge']);
$old_price = isset($_POST['old_price']) ? floatval($_POST['old_price']) : null;
$feature_video_id = trim($_POST['feature_video_id']);
$remove_img = isset($_POST['remove_img']);

/*
    id overview title provider instructor
    description price old_price ki_thakbe
    img rating users badge feature_video_id
*/

if (empty($title) || empty($provider)) {
    header("Location: ../../admin/?e=course&id=" . encryptSt($id) . "&error=Title+and+Provider+are+required+fields.");
    exit();
}

try {
    $img_name = null;

    // Get current image (if exists)
    $current_img_stmt = $conn->prepare("SELECT img FROM course WHERE id = ?");
    $current_img_stmt->bind_param("i", $id);
    $current_img_stmt->execute();
    $current_img_result = $current_img_stmt->get_result();
    $current_img = $current_img_result->fetch_assoc()['img'] ?? null;
    $current_img_stmt->close();

    // Upload new image if present
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadImage($_FILES['img'], '../upload/', 'course_');

        if ($upload['success']) {
            // Delete previous image if exists
            if (!empty($current_img) && file_exists('../upload/' . $current_img)) {
                unlink('../upload/' . $current_img);
            }

            $img_name = basename($upload['target_file']);
        } else {
            header("Location: ../../admin/?e=course&id=" . encryptSt($id) . "&error=" . urlencode($upload['message']));
            exit();
        }

    } elseif ($remove_img && !empty($current_img)) {
        // Remove existing image
        if (file_exists('../upload/' . $current_img)) {
            unlink('../upload/' . $current_img);
        }
        $img_name = null;

    } else {
        // Keep existing image
        $img_name = $current_img;
    }

    // Update or Insert
    if (!empty($id)) {
        $sql = "UPDATE course SET 
                title = ?, provider = ?, instructor = ?, description = ?, 
                overview = ?, ki_thakbe = ?, price = ?, old_price = ?, 
                feature_video_id = ?, img = ?, rating = ?, users = ?, badge = ? , status = ?
            WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssddsssdsii",
            $title, $provider, $instructor, $description,
            $overview, $ki_thakbe, $price, $old_price,
            $feature_video_id, $img_name,
            $rating, $users, $badge, $status, $id
        );
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=course&id=" . encryptSt($id) . "&success=Course+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
        } else {
        $sql = "INSERT INTO course 
                (title, provider, instructor, description, overview, 
                ki_thakbe, price, old_price, feature_video_id, img, 
                rating, users, badge, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssddsssdsi",
            $title, $provider, $instructor, $description, $overview,
            $ki_thakbe, $price, $old_price, $feature_video_id, $img_name,
            $rating, $users, $badge, $status
        );
        if ($stmt->execute()) {
            $new_id = $conn->insert_id;
            $stmt->close();
            header("Location: ../../admin/?e=course&id=" . encryptSt($new_id) . "&success=Course+created+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    }

} catch (Exception $e) {
    header("Location: ../../admin/?e=course&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>