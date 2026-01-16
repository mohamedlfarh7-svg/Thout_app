<?php
require_once '../core/Database.php';

class Student {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function findByEmail($email) {
        $email = $this->db->escape($email);
        $result = $this->db->query("SELECT * FROM students WHERE email = '$email'");
        return $result->fetch_assoc();
    }
    
    public function findById($id) {
        $id = $this->db->escape($id);
        $result = $this->db->query("SELECT * FROM students WHERE id = '$id'");
        return $result->fetch_assoc();
    }
    
    public function create($name, $email, $password) {
        $name = $this->db->escape($name);
        $email = $this->db->escape($email);
        
        $sql = "INSERT INTO students (name, email, password) 
                VALUES ('$name', '$email', '$password')";
        
        return $this->db->query($sql);
    }
    
    public function getEnrollments($studentId) {
        $studentId = $this->db->escape($studentId);
        $sql = "SELECT c.* FROM courses c
                JOIN enrollments e ON c.id = e.course_id
                WHERE e.student_id = '$studentId'";
        
        $result = $this->db->query($sql);
        $enrollments = [];
        
        while ($row = $result->fetch_assoc()) {
            $enrollments[] = $row;
        }
        
        return $enrollments;
    }
}
?>