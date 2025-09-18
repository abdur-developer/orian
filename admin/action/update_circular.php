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
$remove_img_2 = isset($_POST['remove_img_2']);
$remove_img_3 = isset($_POST['remove_img_3']);


if (empty($title) || empty($organization)) {
    header("Location: ../../admin/?e=circulars&id=" . encryptSt($id) . "&error=Title+and+Organization+are+required+fields.");
    exit();
}

try {
    $img_name = null;
    $img_name_2 = null;
    $img_name_3 = null;

    // Get current image (if exists)
    $current_img_stmt = $conn->prepare("SELECT img, img_2, img_3 FROM circulars WHERE id = ?");
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
            $upload = uploadImage($file, '../upload/', 'circular_');

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
        header("Location: ../../admin/?e=product&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
        exit();
    }

    // Update or Insert
    if (!empty($id)) {
        $sql = "UPDATE circulars SET 
                    title = ?, organization = ?, location = ?, sort_text = ?, 
                    description = ?, img = ?, img_2 = ?, img_3 = ?, dateline = ?, g_form_link = ?, 
                    vacancy = ?, updated_at = NOW() 
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssii",
            $title, $organization, $location, $sort_text, $description,
            $img_name, $img_name_2, $img_name_3, $dateline, $g_form_link, $vacancy, $id
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
                    (title, organization, location, sort_text, description, img, img_2, img_3, dateline, g_form_link, vacancy) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssss",
            $title, $organization, $location, $sort_text, $description,
            $img_name, $img_name_2, $img_name_3, $dateline, $g_form_link, $vacancy
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
