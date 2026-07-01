<?php
include_once "../../include/dbcon.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=job_apply&error=Invalid+request');
    exit();
}

// Get form data
$id = $_POST['id'] ?? null;
$name = trim($_POST['name']);
$details = trim($_POST['details']);
$google_form = trim($_POST['google_form']);
$parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : null;

if (empty($name)) {
    header("Location: ../../admin/?e=job_apply&id=" . encryptSt($id) . "&error=Name+are+required+fields.");
    exit();
}


// Update or Insert
if (!empty($id)) {
    $sql = "UPDATE job_apply SET name = ?, details = ?, google_form = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $details, $google_form, $id);
    
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../../admin/?e=job_apply&id=" . encryptSt($id) . "&success=Circular+updated+successfully!");
        exit();
    } else {
        throw new Exception("Database error: " . $stmt->error);
    }
} else {
    $sql = "INSERT INTO job_apply (parent_id, name, details, google_form) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $parent_id, $name, $details, $google_form);
    if ($stmt->execute()) {
        $new_id = $conn->insert_id;
        $stmt->close();
        header("Location: ../../admin/?e=job_apply&id=" . encryptSt($new_id) . "&success=Circular+created+successfully!");
        exit();
    } else {
        throw new Exception("Database error: " . $stmt->error);
    }
}

$conn->close();
?>
