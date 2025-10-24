<?php
header('Content-Type: application/json');
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$password = $data['password'];

if($password == '1709409266'){
    require "../../../../../../include/dbcon.php";
    mysqli_query($conn,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    
    $sql = "SELECT COUNT(*) as total FROM users";
    $total_result = $conn->query($sql);
    
    $temp = array();
    $temp['total'] = $total_result->fetch_assoc()['total'];
    
    echo json_encode($temp, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    $conn->close();
}else header("location: index.php");

    
?>