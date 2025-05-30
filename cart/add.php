<?php 
require_once '../include/dbcon.php';
$type = $_GET['type']; //course, product
$id = decryptSt($_GET['thanks']); //course_id, product_id

$sql = "INSERT INTO cart (user_id, type, ref_id) VALUES ('{$_SESSION['user_id']}', '$type', '$id')";

if(mysqli_query($conn, $sql)) {
    header("Location: index.php?success=".urldecode("Successfully added to cart!"));
} else {
    header("Location: index.php?error=".urldecode("Failed to add to cart!"));
}