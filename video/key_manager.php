<?php
class KeyManager {
    private const KEY_FILE = __DIR__ . '/keys.json';
    private static $currentKey = null;

    public static function getCurrentKey() {
        if (self::$currentKey === null) {
            self::initializeKeyFile();
            
            $content = @file_get_contents(self::KEY_FILE);
            if ($content === false) {
                throw new RuntimeException("Key file could not be read.");
            }

            $keys = json_decode($content, true);
            if (!is_array($keys) || !isset($keys['key'])) {
                self::regenerateKey();
                $content = @file_get_contents(self::KEY_FILE);
                $keys = json_decode($content, true);
            }

            self::$currentKey = $keys['key'];
        }

        return self::$currentKey;
    }

    public static function validateToken($token, $video, $expires) {
        $key = self::getCurrentKey();
        $data = json_encode(['video' => $video, 'expires' => $expires], JSON_UNESCAPED_SLASHES);
        $expected = hash_hmac('sha256', $data, $key);
        return hash_equals($expected, $token);
    }

    private static function initializeKeyFile() {
        if (!file_exists(self::KEY_FILE) || filesize(self::KEY_FILE) === 0) {
            self::regenerateKey();
        }
    }

    private static function regenerateKey() {
        $newKey = bin2hex(random_bytes(32));
        $data = [
            'key' => $newKey,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents(self::KEY_FILE, $json);
        chmod(self::KEY_FILE, 0600);
        self::$currentKey = $newKey;
    }

    public static function rotateKey() {
        self::regenerateKey();
    }
}
?>
