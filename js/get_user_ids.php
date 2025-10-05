<?php
header('Content-Type: application/json');
require_once "../include/dbcon.php"; // DB connection

$sql = "SELECT user_id FROM messages GROUP BY user_id ORDER BY MAX(timestamp) DESC";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['user_id'];
    }
}

echo json_encode($users);
$conn->close();
?>
