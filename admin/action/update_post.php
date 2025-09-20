<?php
include_once "../../include/dbcon.php";
include_once "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=post&error=Invalid+request');
    exit();
}
// Get form data
$id = $_POST['id'];
$title = trim($_POST['title']);
$category = trim($_POST['category']);
$sort_text = trim($_POST['sort_text']);
$text = $_POST['text']; // Quill HTML input
$date = date('d F Y', strtotime($_POST['date']));
$tags = $_POST['tags'];
$remove_img = isset($_POST['remove_img']);
$remove_img_2 = isset($_POST['remove_img_2']);
$remove_img_3 = isset($_POST['remove_img_3']);

if (empty($title) || empty($category)) {
    header("Location: ../../admin/?e=post&id=" . encryptSt($id) . "&error=Title+and+Organization+are+required+fields.");
    exit();
}

try {
    $img_name = null;
    $img_name_2 = null;
    $img_name_3 = null;

    // Get current image (if exists)
    $current_img_stmt = $conn->prepare("SELECT img, img_2, img_3 FROM post WHERE id = ?");
    $current_img_stmt->bind_param("i", $id);
    $current_img_stmt->execute();
    $current_img_result = $current_img_stmt->get_result()->fetch_assoc();

    $current_img = $current_img_result['img'] ?? null;
    $current_img_2 = $current_img_result['img_2'] ?? null;
    $current_img_3 = $current_img_result['img_3'] ?? null;
    $current_img_stmt->close();

    $images = [
        [$remove_img, $current_img],
        [$remove_img_2, $current_img_2],
        [$remove_img_3, $current_img_3],
    ];

    for ($i = 0; $i < 3; $i++) {
        $xx = $images[$i]; // Changed $id to $i
        if ($xx[0] && !empty($xx[1])) {
            if (file_exists('../upload/' . $xx[1])) {
                unlink('../upload/' . $xx[1]);
            }
            // Set the corresponding variable to null
            if ($i == 0) {
                $current_img = null; 
            }elseif($i == 1){
                $current_img_2 = null;
            }else{
                $current_img_3 = null;
            }
        }
    }

    // Function to handle image upload
    function handleImageUpload($file, $current_img) {
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $upload = uploadImage($file, '../upload/', 'product_');

            if ($upload['success']) {
                // Delete previous image if exists
                if (!empty($current_img) && file_exists('../upload/' . $current_img)) {
                    unlink('../upload/' . $current_img);
                }
                return basename($upload['target_file']);
            } else {
                throw new Exception($upload['message']);
            }
        }
        return $current_img; // Keep existing image
    }

    // Upload new images
    try {
        $img_name = handleImageUpload($_FILES['img'], $current_img);
        $img_name_2 = handleImageUpload($_FILES['img_2'], $current_img_2);
        $img_name_3 = handleImageUpload($_FILES['img_3'], $current_img_3);
    } catch (Exception $e) {
        header("Location: ../../admin/?e=post&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
        exit();
    }

    // Update or Insert
    if (!empty($id)) {
        $sql = "UPDATE post SET 
                    title = ?, category = ?, sort_text = ?, 
                    text = ?, img = ?, img_2 = ?, img_3 = ?, date = ?, tags = ?, updated_at = NOW() 
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssi",
            $title, $category, $sort_text, $text,
            $img_name, $img_name_2, $img_name_3, $date, $tags, $id
        );
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=post&id=" . encryptSt($id) . "&success=Post+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } else {
        $sql = "INSERT INTO post 
                    (title, category, sort_text, text, img, img_2, img_3, date, tags) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssss",
            $title, $category, $sort_text, $text, $img_name, $img_name_2, $img_name_3, $date, $tags
        );
        if ($stmt->execute()) {
            $new_id = $conn->insert_id;
            $stmt->close();
            header("Location: ../../admin/?e=post&id=" . encryptSt($new_id) . "&success=Post+created+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    }


} catch (Exception $e) {
    header("Location: ../../admin/?e=post&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
