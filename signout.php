<?php
function deleteCookie($name) {
    setcookie($name, '', [
        'expires' => time() - 3600,
        'path' => '/',
        'domain' => '', //set domain
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    if (isset($_COOKIE[$name])) {
        unset($_COOKIE[$name]);
    }
}
deleteCookie('user_id');
deleteCookie('number');
deleteCookie('web');
header("Location: index.php");
exit();