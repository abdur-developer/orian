<?php
include_once "../../include/dbcon.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../admin/?q=questions&error=Invalid+request');
    exit();
}

// Get form data
$id = $_POST['id'] ?? null;
$question = $_POST['question'] ?? '';
$options = $_POST['options'] ?? [];
$answer = $_POST['answer'] ?? null;
$explanation = $_POST['explanation'] ?? '';

// Validate required fields
if (empty($question)) {
    header("Location: ../../admin/?e=questions&id=" . encryptSt($id) . "&error=Question+is+required");
    exit();
}

if (empty($options) || count($options) != 4) {
    header("Location: ../../admin/?e=questions&id=" . encryptSt($id) . "&error=All+4+options+are+required");
    exit();
}

if ($answer === null || !in_array($answer, [0, 1, 2, 3])) {
    header("Location: ../../admin/?e=questions&id=" . encryptSt($id) . "&error=Please+select+the+correct+answer");
    exit();
}

$options_json = json_encode($options);

if (!empty($id)) {
    // Update existing question
    $sql = "UPDATE questions SET question = ?, options = ?, answer = ?, explanation = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $question, $options_json, $answer, $explanation, $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../../admin/?e=questions&id=" . encryptSt($id) . "&success=Question+updated+successfully!");
        exit();
    } else {
        throw new Exception("Database error: " . $stmt->error);
    }
} else {
    // Insert new question
    $sql = "INSERT INTO questions (question, options, answer, explanation) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $question, $options_json, $answer, $explanation);
    
    if ($stmt->execute()) {
        $new_id = $conn->insert_id;
        $stmt->close();
        header("Location: ../../admin/?e=questions&id=" . encryptSt($new_id) . "&success=Question+created+successfully!");
        exit();
    } else {
        throw new Exception("Database error: " . $stmt->error);
    }
}

$conn->close();
?>