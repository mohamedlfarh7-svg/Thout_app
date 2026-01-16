<?php
require_once '../core/Database.php';

class Enrollment {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function enroll($studentId, $courseId) {
        $studentId = $this->db->escape($studentId);
        $courseId = $this->db->escape($courseId);
        
        $sql = "INSERT INTO enrollments (student_id, course_id) 
                VALUES ('$studentId', '$courseId')";
        
        return $this->db->query($sql);
    }
}
?>