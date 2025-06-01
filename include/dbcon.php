<?php
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "orian";
    // $db_username = "defenceb_web";
    // $db_password = "defenceb_web&&";
    // $dbname = "defenceb_web";


    $conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8");

    function encryptSt($text){
        $enc = openssl_encrypt($text, "AES-128-ECB", "Abdur12345678901", OPENSSL_RAW_DATA);
        return base64_encode($enc);
    }

    function decryptSt($text){
        $txt = str_replace(' ', '+', $text);
        $dec = base64_decode($txt);
        return openssl_decrypt($dec, "AES-128-ECB", "Abdur12345678901", OPENSSL_RAW_DATA);
    }
    function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    function addCookie($name, $value) {
        setcookie($name, $value, [
            'expires' => time() + (86400 * 30),
            'path' => '/',
            'domain' => '', //set domain
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }