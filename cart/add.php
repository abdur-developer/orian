<?php
require_once '../include/dbcon.php';
if(!isset($_COOKIE['number'])) {
    header("Location: ../auth.php?error=Please+login+first!&refer=".urlencode(encryptSt("cart/add.php?type={$_GET['type']}&nani={$_GET['nani']}&thanks={$_GET['thanks']}")));
    exit();
}
$type = $_GET['type']; //course, product, consultant
$id = decryptSt($_GET['thanks']); //course_id, product_id
$price = decryptSt($_GET['nani']); //price of the item
$user_id = decryptSt($_COOKIE['user_id']); // Function to get user ID from session or database

//check if the user already has this item in their cart 
$sql = "SELECT 1 FROM cart WHERE user_id = '$user_id' AND type='$type' AND ref_id = '$id' AND is_running = 1";
if(mysqli_num_rows(mysqli_query($conn, $sql))){
    header("Location: index.php?error=".urldecode("Item already in cart!"));
    exit();
}

$sql = "INSERT INTO cart (user_id, type, price, ref_id) VALUES ('$user_id', '$type', '$price', '$id')";

if($user_id && mysqli_query($conn, $sql)) {
    header("Location: index.php?success=".urldecode("Successfully added to cart!"));
} else {
    header("Location: index.php?error=".urldecode("Failed to add to cart!"));
}