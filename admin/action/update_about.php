<?php
include_once "../../include/dbcon.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?e=about&error=Invalid+request');
    exit();
}

// Get form data
$id = 1;
$who = trim($_POST['who']);
$aim = trim($_POST['aim']);
$service = trim($_POST['service']);
$why = trim($_POST['why']);

if (empty($who) || empty($aim) || empty($service) || empty($why)) {
    header("Location: ../../admin/?e=about&error=all+fields+are+required.");
    exit();
}

try {
    // Update or Insert
    $sql = "UPDATE about SET who = ?, aim = ?, service = ?, why = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $who, $aim, $service, $why, $id);
    
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../../admin/?e=about&success=about+updated+successfully!");
        exit();
    } else {
        throw new Exception("Database error: " . $stmt->error);
    }
    


} catch (Exception $e) {
    header("Location: ../../admin/?e=about&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
