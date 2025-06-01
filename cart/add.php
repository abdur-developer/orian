<?php
require_once '../include/dbcon.php';
if(!isset($_SESSION['number'])) {
    header("Location: ../auth.php?error=Please+login+first!&refer=".urlencode(encryptSt("cart/add.php?type={$_GET['type']}&thanks={$_GET['thanks']}")));
    exit();
}
$type = $_GET['type']; //course, product
$id = decryptSt($_GET['thanks']); //course_id, product_id
$user_id = decryptSt($_SESSION['user_id']); // Function to get user ID from session or database

//check if the user already has this item in their cart 
$sql = "SELECT 1 FROM cart WHERE user_id='$user_id' AND type='$type' AND ref_id='$id'";
if(mysqli_num_rows(mysqli_query($conn, $sql))){
    header("Location: index.php?error=".urldecode("Item already in cart!"));
    exit();
}

$sql = "INSERT INTO cart (user_id, type, ref_id) VALUES ('$user_id', '$type', '$id')";

if($user_id && mysqli_query($conn, $sql)) {
    header("Location: index.php?success=".urldecode("Successfully added to cart!"));
} else {
    header("Location: index.php?error=".urldecode("Failed to add to cart!"));
}