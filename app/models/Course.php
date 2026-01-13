<?php

class Course
{
    public $id;
    public $title;
    public $description;

    public static function getAll()
    {
        $sql = "SELECT * FROM courses ORDER BY created_at DESC";
        $stmt = Database::getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id)
    {
        $sql = "SELECT * FROM courses WHERE id = ?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function getAvailableCourses($studentId = null)
    {
        if ($studentId) {
            $sql = "SELECT c.*, 
                   IF(e.id IS NOT NULL, true, false) as is_enrolled
                   FROM courses c
                   LEFT JOIN enrollments e ON c.id = e.course_id AND e.student_id = ?
                   ORDER BY c.created_at DESC";
            $stmt = Database::getConnection()->prepare($sql);
            $stmt->execute([$studentId]);
        } else {
            $sql = "SELECT * FROM courses ORDER BY created_at DESC";
            $stmt = Database::getConnection()->query($sql);
        }
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function create($data)
    {
        $sql = "INSERT INTO courses (title, description) VALUES (?, ?)";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['description']
        ]);
    }

    public static function update($id, $data)
    {
        $sql = "UPDATE courses SET title = ?, description = ? WHERE id = ?";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $id
        ]);
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM courses WHERE id = ?";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>