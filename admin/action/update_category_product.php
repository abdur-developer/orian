<?php
include_once "../../include/dbcon.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=category_product&error=Invalid+request');
    exit();
}

// Get form data
$id = $_POST['id'];
$name = trim($_POST['name']);

if (empty($name)) {
    header("Location: ../../admin/?e=category_product&id=" . encryptSt($id) . "&error=name+is+required+fields.");
    exit();
}

try {
    // Update or Insert
    if (!empty($id)) {
        $sql = "UPDATE category_product SET name = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si",$name, $id);
        
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../../admin/?e=category_product&id=" . encryptSt($id) . "&success=category_product+updated+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } else {
        $sql = "INSERT INTO category_product (name) VALUES (?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            $new_id = $conn->insert_id;
            $stmt->close();
            header("Location: ../../admin/?e=category_product&id=" . encryptSt($new_id) . "&success=category_product+created+successfully!");
            exit();
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    }


} catch (Exception $e) {
    header("Location: ../../admin/?e=category_product&id=" . encryptSt($id) . "&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
