<?php

   class DB
    {
        private $host = 'localhost';
        private $DB_name = 'adise2021';
        private $username = 'root';
        private $password = '';
        private $conn;
        
        public function connect()
        {
            $this->conn = null;
            
            try
            {
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->DB_name,$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e)
            {
                echo 'Connection Error : '. $e->getMessage();
            }
            return $this->conn;
        }
    }


?>