<?php

   class DB
    {
        private $host = 'localhost';
        private $db = 'adise2021';
        private $user = 'root';
        private $pass = '';
        private $conn;
        // echo "c";
        public function connect()
        {
            $this->conn = null;
            // echo "b";

if(gethostname()=='users.iee.ihu.gr') {
    $this->conn =new mysqli($this->host, $this->user,$this->pass, $this->db,null,'/home/student/it/2018/it185222/mysql/run/mysql.sock');
    print_r($conn);
    
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