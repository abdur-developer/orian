<?php 
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

// Encrypt password
$postData = [
    ["password" => encryptData('1709409266')]
];

// Convert to JSON
$jsonData = json_encode($postData);

// Send request
$options = [     
    'http' => [         
        'header'  => "Content-Type: application/json\r\n",         
        'method'  => 'POST',         
        'content' => $jsonData,     
    ], 
];  

$context  = stream_context_create($options); 
$response = file_get_contents("http://localhost:8080/orian/sort/secure/api/dont/view/this/abdur.php", false, $context);  

if ($response === false) {     
    throw new Exception("API request failed"); 
}  

// Decode JSON
$data = json_decode($response, true); 
if ($data === null) {     
    throw new Exception("Failed to decode JSON response"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table</title>
</head>
<body>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e6f7ff;
        }
    </style>
    <table>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Email</th>
        </tr>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['number']) ?></td>
                <td><?= htmlspecialchars($item['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
