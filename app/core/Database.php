<?php
class Database {
    private $connection;
    
    public function __construct() {
        global $db_config;
        
        $this->connection = new mysqli(
            $db_config['host'],
            $db_config['username'],
            $db_config['password'],
            $db_config['database']
        );
        
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    
    public function query($sql) {
        return $this->connection->query($sql);
    }
    
    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }
    
    public function getLastInsertId() {
        return $this->connection->insert_id;
    }
}
?>