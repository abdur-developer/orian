<?php
include_once "../../include/dbcon.php";
include_once "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=product&error=Invalid+request');
    exit();
}

// Get form data
$id = $_POST['id'];
$name = trim($_POST['name']);
$type = trim($_POST['type']);
$price = intval($_POST['price']);
$old_price = intval($_POST['old_price']);
$rating_count = intval($_POST['rating_count']);
$is_feature = intval($_POST['is_feature']);
$description = $_POST['description']; // Quill HTML input
$review = $_POST['review'];
$status = $_POST['status'];
$remove_img = isset($_POST['remove_img']);

if (empty($name) || empty($type)) {
    header("Location: ../../admin/?e=product&id=" . encryptSt($id) . "&error=Title+and+Organization+are+required+fields.");
    exit();
}

try {
    $img_name = null;

    // Get current image (if exists)
    $current_img_stmt = $conn->prepare("SELECT img FROM product WHERE id = ?");
    $current_img_stmt->bind_param("i", $id);
    $current_img_stmt->execute();
    $current_img_result = $current_img_stmt->get_result();
    $current_img = $current_img_result->fetch_assoc()['img'] ?? null;
    $current_img_stmt->close();

    // Upload new image if present
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadImage($_FILES['img'], '../upload/', 'product_');

        if ($upload['success']) {
            // Delete previous image if exists
            if (!empty($current_img) && file_exists('../upload/' . $current_img)) {
                unlink('../upload/' . $current_img);
            }

            $img_name = basename($upload['target_file']);
        } else {
            header("Location: ../../admin/?e=product&id=" . encryptSt($id) . "&error=" . urlencode($upload['message']));
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
        $sql = "UPDATE product SET 
                    name = ?, type = ?, price = ?, old_price = ?, rating_count = ?,
                    description = ?, img = ?, review = ?, status = ?, is_feature = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssiiissssii",
            $name, $type, $price, $old_price ,$rating_count, $description,
            $img_name, $review, $status, $is_feature, $id
        );
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=product&id=" . encryptSt($id) . "&success=Post+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } else {
        $sql = "INSERT INTO product 
                    (name ,type ,price ,old_price ,rating_count ,img ,description ,review ,status, is_feature) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssiiissssi",
            $name, $type, $price, $old_price, $rating_count, $img_name, $description, $review, $status, $is_feature
        );
        if ($stmt->execute()) {
            $new_id = $conn->insert_id;
            $stmt->close();
            header("Location: ../../admin/?e=product&id=" . encryptSt($new_id) . "&success=Post+created+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    }


} catch (Exception $e) {
    header("Location: ../../admin/?e=product&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
