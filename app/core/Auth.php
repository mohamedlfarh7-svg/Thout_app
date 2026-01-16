<?php
class Auth {
    public static function check() {
        return isset($_SESSION['user_id']);
    }
    
    public static function user() {
        return $_SESSION['user_id'] ?? null;
    }
    
    public static function login($user_id) {
        $_SESSION['user_id'] = $user_id;
    }
    
    public static function logout() {
        session_destroy();
    }
}
?>