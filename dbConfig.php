<?php

    class Database
    {
        public $host = "localhost";
        public $db_username = "root";
        public $db_password = "";
        public $db_name = "online-barangay-portal";

        public $conn;

        public function dbConnection()
        {
            $this->conn = null;
            
            try
            {
                $this->conn = new PDO("mysql:host=". $this->host . ";dbname=" .$this->db_name , $this->db_username, $this->db_password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ));
            }
            catch (PDOException $exception)
            {
                echo "Connection Error " . $exception->getMessage();
            }

            return $this->conn;
        }
    } 

?>