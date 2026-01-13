<?php

class Enrollment
{
    public $id;
    public $student_id;
    public $course_id;
    public $enrollment_date;

    public static function enroll($studentId, $courseId)
    {
        $sql = "INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)";
        $stmt = Database::getConnection()->prepare($sql);
        try {
            return $stmt->execute([$studentId, $courseId]);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function isEnrolled($studentId, $courseId)
    {
        $sql = "SELECT * FROM enrollments WHERE student_id = ? AND course_id = ?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([$studentId, $courseId]);
        return $stmt->fetch(PDO::FETCH_OBJ) !== false;
    }

    public static function getStudentCourses($studentId)
    {
        $sql = "SELECT c.*, e.enrollment_date 
                FROM courses c
                JOIN enrollments e ON c.id = e.course_id
                WHERE e.student_id = ?
                ORDER BY e.enrollment_date DESC";
        
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getEnrollmentsByCourse($courseId)
    {
        $sql = "SELECT s.*, e.enrollment_date 
                FROM students s
                JOIN enrollments e ON s.id = e.student_id
                WHERE e.course_id = ?
                ORDER BY e.enrollment_date DESC";
        
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function unenroll($studentId, $courseId)
    {
        $sql = "DELETE FROM enrollments WHERE student_id = ? AND course_id = ?";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute([$studentId, $courseId]);
    }

    public static function countByCourse($courseId)
    {
        $sql = "SELECT COUNT(*) as count FROM enrollments WHERE course_id = ?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([$courseId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->count;
    }
}