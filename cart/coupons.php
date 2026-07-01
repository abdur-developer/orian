<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../include/dbcon.php';

$sql = "SELECT code, discount FROM coupons";
$result = $conn->query($sql);

$coupons = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $coupons[$row['code']] = (int)$row['discount'];
    }
}

$conn->close();
echo json_encode($coupons);