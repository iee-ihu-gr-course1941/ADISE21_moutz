<?php

   class DB
    {
        private $host = 'localhost';
        private $db = 'adise2021';
        private $user = 'root';
        private $password = '';
        private $conn;
        // echo "c";
        public function connect()
        {
            $this->conn = null;

            try
            {
                if(gethostname()=='users.iee.ihu.gr') {
                   
                    // $this->conn =new PDO('mysql:host='.$this->host.';dbname='.$this->db,$this->user,$this->password,[PDO::ATTR_PERSISTENT => true]);
                    $this->conn =mysqli($this->host, $this->user, $this->password, $this->db,null,'/home/staff/asidirop/mysql/run/mysql.sock');
                    echo " $this->conn";
                }else{
                    $this->conn =new PDO('mysql:host='.$this->host.';dbname='.$this->db,$this->user,$this->pass);
            }
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e)
            {
                echo 'Connection Error : '. $e->getMessage();
            }
            return $this->conn;
        }
    }


?>