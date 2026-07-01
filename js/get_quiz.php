<?php
header('Content-Type: application/json');

require_once "../include/dbcon.php"; // DB connection here

$result = $conn->query("SELECT * FROM questions ORDER BY RAND() LIMIT 10");
$quizData = [];

while ($row = $result->fetch_assoc()) {
    $quizData[] = [
        "question" => $row['question'],
        "options" => json_decode($row['options']),
        "answer" => (int)$row['answer'],
        "explanation" => $row['explanation']
    ];
}

echo json_encode($quizData, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
