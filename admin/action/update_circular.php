<?php
include_once "../../include/dbcon.php";
include_once "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=circulars&error=Invalid+request');
    exit();
}

// Get form data
$id = $_POST['id'];
$title = trim($_POST['title']);
$organization = trim($_POST['organization']);
$location = trim($_POST['location']);
$sort_text = trim($_POST['sort_text']);
$description = $_POST['description']; // Quill HTML input
$dateline = date('d F Y', strtotime($_POST['dateline']));
$g_form_link = trim($_POST['g_form_link']);
$vacancy = intval($_POST['vacancy']);
$remove_img = isset($_POST['remove_img']);

if (empty($title) || empty($organization)) {
    header("Location: ../../admin/?e=circulars&id=" . encryptSt($id) . "&error=Title+and+Organization+are+required+fields.");
    exit();
}

try {
    $img_name = null;

    // Get current image (if exists)
    $current_img_stmt = $conn->prepare("SELECT img FROM circulars WHERE id = ?");
    $current_img_stmt->bind_param("i", $id);
    $current_img_stmt->execute();
    $current_img_result = $current_img_stmt->get_result();
    $current_img = $current_img_result->fetch_assoc()['img'] ?? null;
    $current_img_stmt->close();

    // Upload new image if present
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadImage($_FILES['img'], '../upload/', 'circular_');

        if ($upload['success']) {
            // Delete previous image if exists
            if (!empty($current_img) && file_exists('../upload/' . $current_img)) {
                unlink('../upload/' . $current_img);
            }

            $img_name = basename($upload['target_file']);
        } else {
            header("Location: ../../admin/?e=circulars&id=" . encryptSt($id) . "&error=" . urlencode($upload['message']));
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
        $sql = "UPDATE circulars SET 
                    title = ?, organization = ?, location = ?, sort_text = ?, 
                    description = ?, img = ?, dateline = ?, g_form_link = ?, 
                    vacancy = ?, updated_at = NOW() 
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssii",
            $title, $organization, $location, $sort_text, $description,
            $img_name, $dateline, $g_form_link, $vacancy, $id
        );
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=circulars&id=" . encryptSt($id) . "&success=Circular+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } else {
        $sql = "INSERT INTO circulars 
                    (title, organization, location, sort_text, description, img, dateline, g_form_link, vacancy) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssii",
            $title, $organization, $location, $sort_text, $description,
            $img_name, $dateline, $g_form_link, $vacancy
        );
        if ($stmt->execute()) {
            $new_id = $conn->insert_id;
            $stmt->close();
            header("Location: ../../admin/?e=circulars&id=" . encryptSt($new_id) . "&success=Circular+created+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    }


} catch (Exception $e) {
    header("Location: ../../admin/?e=circulars&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
