<?php
    
    class Database {
        public $host = "localhost";
        public $username = "root";
        public $password = "";  
        public $db = "brewhavenph";
        public $connection;
    

        public function __construct() {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db);
    
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        }

        function getConnection() {
            return $this->connection;
        }
    }
?>