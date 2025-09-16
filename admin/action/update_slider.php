<?php
include_once "../../include/dbcon.php";
include_once "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=slider&error=Invalid+request');
    exit();
}

// Get form data
$id = $_POST['id'];
$link = trim($_POST['link']);

if (empty($link)) {
    header("Location: ../../admin/?e=slider&id=" . encryptSt($id) . "&error=link+are+required+fields.");
    exit();
}

try {
    $img_name = null;

    // Get current image (if exists)
    $current_img_stmt = $conn->prepare("SELECT img FROM slider WHERE id = ?");
    $current_img_stmt->bind_param("i", $id);
    $current_img_stmt->execute();
    $current_img_result = $current_img_stmt->get_result();
    $row = $current_img_result->fetch_assoc();
    $current_img = $row['img'];
    $current_img_stmt->close();

    // Upload new image if present
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadImage($_FILES['img'], '../upload/', 'slider_');

        if ($upload['success']) {
            // Delete previous image if exists
            if (!empty($current_img) && file_exists('../upload/' . $current_img)) {
                unlink('../upload/' . $current_img);
            }

            $img_name = basename($upload['target_file']);
        } else {
            header("Location: ../../admin/?e=slider&id=" . encryptSt($id) . "&error=" . urlencode($upload['message']));
            exit();
        }

    } else {
        // Keep existing image
        $img_name = $current_img;
    }

    // Update or Insert
    if (!empty($id)) {
        $sql = "UPDATE slider SET link = ?, img = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi",$link, $img_name, $id);
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=slider&id=" . encryptSt($id) . "&success=slider+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } else {
        $sql = "INSERT INTO slider (link, img) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $link, $img_name);
        if ($stmt->execute()) {
            $new_id = $conn->insert_id;
            $stmt->close();
            header("Location: ../../admin/?e=slider&id=" . encryptSt($new_id) . "&success=slider+created+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    }


} catch (Exception $e) {
    header("Location: ../../admin/?e=slider&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
