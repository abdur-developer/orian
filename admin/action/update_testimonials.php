<?php
include_once "../../include/dbcon.php";
include_once "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=testimonials&error=Invalid+request');
    exit();
}

// Get form data
$id = $_POST['id'];
$name = trim($_POST['name']);
$message = trim($_POST['message']);
$sector = trim($_POST['sector']);

if (empty($name) || empty($message)) {
    header("Location: ../../admin/?e=testimonials&id=" . encryptSt($id) . "&error=name+and+message+are+required+fields.");
    exit();
}

try {
    $img_name = null;

    // Get current image (if exists)
    $current_img_stmt = $conn->prepare("SELECT img FROM testimonials WHERE id = ?");
    $current_img_stmt->bind_param("i", $id);
    $current_img_stmt->execute();
    $current_img_result = $current_img_stmt->get_result();
    $row = $current_img_result->fetch_assoc();
    if ($row && !empty($row['img'])) {
        $current_img = $row['img'];
    } else {
        $randNum = rand(1, 99);
        $current_img = "https://randomuser.me/api/portraits/men/{$randNum}.jpg";
    }
    $current_img_stmt->close();

    // Upload new image if present
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadImage($_FILES['img'], '../upload/', 'users_');

        if ($upload['success']) {
            // Delete previous image if exists
            if (!empty($current_img) && file_exists('../upload/' . $current_img)) {
                unlink('../upload/' . $current_img);
            }

            $img_name = basename($upload['target_file']);
        } else {
            header("Location: ../../admin/?e=testimonials&id=" . encryptSt($id) . "&error=" . urlencode($upload['message']));
            exit();
        }

    } else {
        // Keep existing image
        $img_name = $current_img;
    }

    // Update or Insert
    if (!empty($id)) {
        $sql = "UPDATE testimonials SET name = ?, message = ?, sector = ?, img = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi",$name, $message, $sector, $img_name, $id);
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=testimonials&id=" . encryptSt($id) . "&success=Testimonials+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } else {
        /*name img message sector */
        $sql = "INSERT INTO testimonials (name, message, sector, img) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $message, $sector, $img_name);
        if ($stmt->execute()) {
            $new_id = $conn->insert_id;
            $stmt->close();
            header("Location: ../../admin/?e=testimonials&id=" . encryptSt($new_id) . "&success=Testimonials+created+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    }


} catch (Exception $e) {
    header("Location: ../../admin/?e=testimonials&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
