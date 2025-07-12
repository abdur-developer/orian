<?php
session_start();
include_once "../include/dbcon.php";
function isLogged() {
    if (!isset($_SESSION['user_id'], $_SESSION['login_time'], $_SESSION['password_hash'])) {
        return false;
    }

    global $conn;
    $user_id = $_SESSION['user_id'];
    $stmt = mysqli_prepare($conn, "SELECT password FROM admin WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$user || $user['password'] !== $_SESSION['password_hash']) {
        header("location: logout.php");
        exit;
    }

    return true;
}
function chotoKro($str, $len=50){
    return substr($str, 0, $len) . "...";
}


if(!isLogged()){
    header("location: auth.php?error=session_expire");
}
if(isset($_REQUEST['admin-username'])){
    $username = trim($_REQUEST['admin-username']);
    $password = $_REQUEST['password'];

    // Basic validation
    if (empty($username) || empty($password)) return;
    if (strlen($password) < 6) return;

    // Hash the password securely
    $pp = '';
    if(!str_starts_with($password, '$2y')){
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $pp = ", password = '$hashed_password'";
    }

    try {
        $sql = "UPDATE admin SET username = '$username' $pp WHERE id = 1";
        if (mysqli_query($conn, $sql)) header("Location: ?q=settings&success=successfully+Updated");
        
    } catch (Exception $e) {
        header("Location: ?q=settings&success=updated+failed");
    }
}elseif(isset($_REQUEST['chat_suggestion_question'])){
    $id = isset($_REQUEST['editId']) ? intval($_REQUEST['editId']) : '';
    $question = $_REQUEST['chat_suggestion_question'];
    $reply = isset($_REQUEST['reply']) ? $_REQUEST['reply'] : '';
    $type = isset($_REQUEST['type']) ? intval($_REQUEST['type']) : 0;//is_initial
    $parentId = isset($_REQUEST['parentId']) ? intval($_REQUEST['parentId']) : null;

    if ($type == 1) $parentId = null;
    if ($id) {
        // Update existing suggestion
        $sql = "UPDATE chat_suggestions SET message_text = ?, response_text = ?, is_initial = ?, parent_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiii", $question, $reply, $type, $parentId, $id);
    } else {
        // Insert new suggestion
        $sql = "INSERT INTO chat_suggestions (message_text, response_text, is_initial, parent_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $question, $reply, $type, $parentId);
    }   

    if ($stmt->execute()) {
        header("Location: index.php?q=chat_suggestions&success=Suggestion+saved+successfully.");
        exit;
    } else {
        header("Location: index.php?q=chat_suggestions&error=" . urlencode("Error: " . $stmt->error));
        exit;
    }

    $stmt->close();
}elseif(isset($_REQUEST['coupons_code'])){
    $id = isset($_REQUEST['editId']) ? intval($_REQUEST['editId']) : '';
    $code = $_REQUEST['coupons_code'];
    $discount = intval($_REQUEST['discount']);

    if ($id) {
        // Update existing suggestion
        $sql = "UPDATE coupons SET code = ?, discount = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $code, $discount, $id);
    } else {
        // Insert new suggestion
        $sql = "INSERT INTO coupons (code, discount) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $code, $discount);
    }   

    if ($stmt->execute()) {
        header("Location: index.php?q=coupons&success=coupons+saved+successfully.");
        exit;
    } else {
        header("Location: index.php?q=coupons&error=" . urlencode("Error: " . $stmt->error));
        exit;
    }

    $stmt->close();
}