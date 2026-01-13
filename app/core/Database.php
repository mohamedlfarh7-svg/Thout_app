<?php

class Database
{
    public static function getConnection()
    {
        static $conn = null;
        
        if ($conn === null) {
            $conn = new PDO(
                "mysql:host=localhost;dbname=thoth_lms;charset=utf8mb4",
                "root",
                ""
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        return $conn;
    }
}
?>