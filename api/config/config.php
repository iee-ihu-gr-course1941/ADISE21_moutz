<?php

   class DB
    {
        private $host = 'localhost';
        private $db = 'adise2021';
        private $user = 'root';
        private $pass = '';
        private $conn;
        
        public function connect()
        {
            $this->conn = null;
            

            $user=$DB_USER;
$pass=$DB_PASS;


if(gethostname()=='users.iee.ihu.gr') {
    $this->conn =new mysqli($this->host, $this->user,$this->pass, $this->db,null,'/home/staff/asidirop/mysql/run/adise2021.sock');
} else {
    $this->conn =new mysqli($this->host, $this->user, $this->pass, $this->db);
}

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . 
    $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
            return $this->conn;
        }
    }


?>