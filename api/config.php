<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

define('DB_PATH', __DIR__ . '/../dbspl/');
define('ENCRYPTION_KEY', 'your-secret-key-change-this-in-production');
define('ALGORITHM', 'AES-256-CBC');

if (!is_dir(DB_PATH)) {
    mkdir(DB_PATH, 0755, true);
}
if (!is_dir(DB_PATH . 'images')) {
    mkdir(DB_PATH . 'images', 0755, true);
}
if (!is_dir(DB_PATH . 'videos')) {
    mkdir(DB_PATH . 'videos', 0755, true);
}

class CryptoUtil {
    public static function encrypt($data) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(ALGORITHM));
        $encrypted = openssl_encrypt(json_encode($data), ALGORITHM, ENCRYPTION_KEY, 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    public static function decrypt($encrypted) {
        $data = base64_decode($encrypted);
        $iv = substr($data, 0, openssl_cipher_iv_length(ALGORITHM));
        $encrypted = substr($data, openssl_cipher_iv_length(ALGORITHM));
        return json_decode(openssl_decrypt($encrypted, ALGORITHM, ENCRYPTION_KEY, 0, $iv), true);
    }
}

class Database {
    public static function getUsers() {
        $path = DB_PATH . 'users.csv';
        if (!file_exists($path)) return [];
        $encrypted = file_get_contents($path);
        return CryptoUtil::decrypt($encrypted);
    }

    public static function saveUsers($users) {
        file_put_contents(DB_PATH . 'users.csv', CryptoUtil::encrypt($users));
    }

    public static function getPosts() {
        $path = DB_PATH . 'posts.csv';
        if (!file_exists($path)) return [];
        $encrypted = file_get_contents($path);
        return CryptoUtil::decrypt($encrypted);
    }

    public static function savePosts($posts) {
        file_put_contents(DB_PATH . 'posts.csv', CryptoUtil::encrypt($posts));
    }

    public static function getVotes() {
        $path = DB_PATH . 'votes.csv';
        if (!file_exists($path)) return [];
        $encrypted = file_get_contents($path);
        return CryptoUtil::decrypt($encrypted);
    }

    public static function saveVotes($votes) {
        file_put_contents(DB_PATH . 'votes.csv', CryptoUtil::encrypt($votes));
    }
}
?>
