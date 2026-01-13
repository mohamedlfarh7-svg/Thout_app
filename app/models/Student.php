<?php

class Student
{
    public $id;
    public $name;
    public $email;
    public $password;

    public static function create($data)
    {
        $sql = "INSERT INTO students (name, email, password) VALUES (?, ?, ?)";
        $db = Database::getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['password']
        ]);
        return $db->lastInsertId();
    }

    public static function findByEmail($email)
    {
        $sql = "SELECT * FROM students WHERE email = ?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function find($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function authenticate($email, $password)
    {
        $student = self::findByEmail($email);
        
        if ($student && password_verify($password, $student->password)) {
            return $student;
        }
        
        return false;
    }

    public static function update($id, $data)
    {
        $sql = "UPDATE students SET name = ?, email = ? WHERE id = ?";
        $stmt = Database::getConnection()->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $id
        ]);
    }
}
?>