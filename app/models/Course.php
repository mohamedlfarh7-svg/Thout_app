<?php
require_once '../core/Database.php';

class Course {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAll() {
        $result = $this->db->query("SELECT * FROM courses");
        $courses = [];
        
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
        
        return $courses;
    }
}
?>