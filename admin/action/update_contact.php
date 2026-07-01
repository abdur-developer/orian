<?php
include_once "../../include/dbcon.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?e=contact&error=Invalid+request');
    exit();
}
// Get form data
$id = 1;
$facebook = trim($_POST['facebook']);
$youtube = trim($_POST['youtube']);
$tiktok = trim($_POST['tiktok']);
$instagram = trim($_POST['instagram']);
$location = trim($_POST['location']);
$number = trim($_POST['number']);
$email = trim($_POST['email']);

if (empty($facebook) || empty($youtube) || empty($tiktok) || empty($instagram) || empty($location) || empty($number) || empty($email)) {
    header("Location: ../../admin/?e=contact&error=all+fields+are+required.");
    exit();
}

try {
    // Update or Insert
    $sql = "UPDATE contact SET facebook = ?, youtube = ?, tiktok = ?, instagram = ?, location = ?, number = ?, email = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $facebook, $youtube, $tiktok, $instagram, $location, $number, $email, $id);
    
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../../admin/?e=contact&success=contact+updated+successfully!");
        exit();
    } else {
        throw new Exception("Database error: " . $stmt->error);
    }
    


} catch (Exception $e) {
    header("Location: ../../admin/?e=contact&error=" . urlencode($e->getMessage()));
    exit();
}

$conn->close();
?>
