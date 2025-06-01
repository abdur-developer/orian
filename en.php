<?php
$number = $_GET['number'] ?? 0;
$encrypted = base64_encode($number ^ 12345);
$decrypted = base64_decode($encrypted) ^ 12345;

echo "Original number: $number<br>";
echo "Encrypted: $encrypted<br>";
echo "Decrypted: $decrypted<br>";