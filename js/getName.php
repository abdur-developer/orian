<?php
if (isset($_GET['id'])) {
    $user_id = (int) $_GET['id'];
    require_once "../include/dbcon.php";
    header('Content-Type: application/json');

    // Combine queries to reduce database calls
    $sql = "
        SELECT u.name, 
               CASE 
                   WHEN EXISTS (
                       SELECT 1 
                       FROM confirm_orders o 
                       JOIN consultant c ON o.product_id = c.id 
                       WHERE o.type = 'consultant' 
                         AND o.validity >= NOW() 
                         AND o.user_id = u.id 
                         AND c.price != 0
                   ) THEN 1 
                   ELSE 0 
               END AS is_pro
        FROM users u
        WHERE u.id = ? 
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name, $is_pro);

    if ($stmt->fetch()) {
        $proHTML = $is_pro ? "<img src='../img/pro.png' alt='pro user' style='width: 15px;'>" : '';
        echo json_encode(['success' => true, 'name' => "$name", "pro" => "$proHTML"]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found', "pro" => ""]);
    }

    $stmt->close();
    $conn->close();
}
?>