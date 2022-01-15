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
    print_r($this->conn);
    
} else {
    $this->conn =new mysqli($this->host, $this->user, $this->pass, $this->db);
}

if ($this.conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . 
    $this.conn->connect_errno . ") " . $this.conn->connect_error;
}
            return $this->conn;
        }
    }


?>