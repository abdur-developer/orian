<?php
$json = file_get_contents('php://input');
$jsonArray = json_decode($json, true);
$data = $jsonArray[0];
$password = $data['password'];
$start = $data['start'];
$limit = $data['limit'];

if(decryptData($password) == '1709409266'){
    require "../../../../../../include/dbcon.php";
    mysqli_query($conn,"SET character_set_results = 'utf8', character_set_client = 'utf8', 
            character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $sql = "SELECT name, number, email FROM users ORDER BY id ASC LIMIT $start, $limit";
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;          
        }
    }
    // JSON ফরম্যাটে প্রিন্ট করা
    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    $conn->close();
}else header("location: index.php");

function decryptData($encryptedData) {
    $key = "AbdurRahman792$%";
    $keyBytes = hash('sha256', $key, true);
    $combined = base64_decode($encryptedData);
    $iv = substr($combined, 0, 12);
    $ciphertext = substr($combined, 12);
    $cipher = 'aes-256-gcm';
    $tagLength = 16;
    $tag = substr($ciphertext, -$tagLength);
    $ciphertext = substr($ciphertext, 0, -$tagLength);

    $decryptedData = openssl_decrypt($ciphertext, $cipher, $keyBytes, OPENSSL_RAW_DATA, $iv, $tag);

    if ($decryptedData === false) {
        throw new Exception("Decryption failed");
    }

    return $decryptedData;
}
/*
function encryptData($plainText) {
    $key = "AbdurRahman792$%";
    $keyBytes = hash('sha256', $key, true);
    $cipher = 'aes-256-gcm';
    $ivLength = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $tagLength = 16;
    $ciphertext = openssl_encrypt($plainText, $cipher, $keyBytes, OPENSSL_RAW_DATA, $iv, $tag, '', $tagLength);

    if ($ciphertext === false) {
        throw new Exception("Encryption failed");
    }

    $encryptedData = base64_encode($iv . $ciphertext . $tag);
    return $encryptedData;
}
*/    
?>