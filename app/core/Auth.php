<?php 
require_once __DIR__ . '/Database.php';

class auth {
    private $db;
     
    public function __construct() {
        $this->db = Database::getConnection();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
    }

    public function register($name, $email, $password) {

        $checkEmail = $this->db->prepare(
            "SELECT id FROM students WHERE email = ?"
        );
        $checkEmail->execute([$email]);

        if ($checkEmail->fetch()) {
            throw new Exception("Cet email est déjà utilisé");
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
    
        $insert = $this->db->prepare(
            "INSERT INTO students (name, email, password) VALUES (?, ?, ?)"
        );

        return $insert->execute([$name, $email, $hash]);
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare(
            "SELECT * FROM students WHERE email = ?"
        );
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            return true;
        }
        
        return false;
    }

    public function isLogged() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
    }
}
?>