<?php
function chotoKro($str, $len=50){
    return substr($str, 0, $len) . "...";
}
include_once "../include/dbcon.php";

if(isset($_REQUEST['chat_suggestion_question'])){
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
}

if(isset($_REQUEST['coupons_code'])){
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