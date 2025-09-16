<?php
include_once "../../include/dbcon.php";
include_once "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=offer&error=Invalid+request');
    exit();
}

// Get form data
$link = trim($_POST['link']);

if (empty($link)) {
    header("Location: ../../admin/?e=offer&error=link+are+required+fields.");
    exit();
}

try {
    $img_name = null;
    $id = 1;
    // Get current image (if exists)
    $current_img_stmt = $conn->prepare("SELECT img FROM offer_banner WHERE id = ?");
    $current_img_stmt->bind_param("i", $id);
    $current_img_stmt->execute();
    $current_img_result = $current_img_stmt->get_result();
    $row = $current_img_result->fetch_assoc();
    $current_img = $row['img'];
    $current_img_stmt->close();

    // Upload new image if present
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadImage($_FILES['img'], '../upload/', 'offer_');

        if ($upload['success']) {
            // Delete previous image if exists
            if (!empty($current_img) && file_exists('../upload/' . $current_img)) {
                unlink('../upload/' . $current_img);
            }

            $img_name = basename($upload['target_file']);
        } else {
            header("Location: ../../admin/?e=offer&error=" . urlencode($upload['message']));
            exit();
        }

    } else {
        // Keep existing image
        $img_name = $current_img;
    }

    // Update 
        $sql = "UPDATE offer_banner SET link = ?, img = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi",$link, $img_name, $id);
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=offer&success=offer+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    


} catch (Exception $e) {
    header("Location: ../../admin/?e=offer&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
