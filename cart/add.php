<?php
require_once '../include/dbcon.php';
if(!isset($_SESSION['number'])) {
    header("Location: ../auth.php?error=Please+login+first!&refer=".urlencode(encryptSt("cart/add.php?type={$_GET['type']}&thanks={$_GET['thanks']}")));
    exit();
}
$type = $_GET['type']; //course, product
$id = decryptSt($_GET['thanks']); //course_id, product_id
$user_id = getUserID(); // Function to get user ID from session or database

$sql = "INSERT INTO cart (user_id, type, ref_id) VALUES ('$user_id', '$type', '$id')";

if($user_id && mysqli_query($conn, $sql)) {
    header("Location: index.php?success=".urldecode("Successfully added to cart!"));
} else {
    header("Location: index.php?error=".urldecode("Failed to add to cart!"));
}
function getUserID() {
    if (isset($_SESSION['number'])) {
        $number = $_SESSION['number'];
        global $conn;
        $stmt = $conn->prepare("SELECT id FROM `users` WHERE `number` = ?");
        $stmt->bind_param("s", $number);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['id'];
        }
    }
    return null;
}   