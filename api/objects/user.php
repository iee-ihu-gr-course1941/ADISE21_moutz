<?php

class User{
 
    // db connection and table name
    private $conn;
    private $table_name = "users";
 
    // object
    public $id;
    public $username;
    public $password;
    public $email;
 
    // constructor $db connection
    public function __construct($db){
        $this->conn = $db;
    }

    //user signup method
    function signup(){
         $query = "SELECT id, username, password
                FROM " . $this->table_name . "
                WHERE username = ?
                LIMIT 0,1";
     
        
        $stmt = $this->conn->prepare( $query );
     
        
        $this->username=htmlspecialchars(strip_tags($this->username));
     
        
        $stmt->bindparam(1, $this->username);
     
        
        $stmt->execute();
     
        
        $num = $stmt->rowCount();
        
        if(!$num>0){
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    username = :username,
                    password = :password,
                    email = :email";
     
       
        $stmt = $this->conn->prepare($query);
     
       
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
       
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
      
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
     
        if($stmt->execute()){
            return true;
        }
    }
        return false;
    }
    // check if user exist
    function UserExists(){
     
        
        $query = "SELECT id, username, password
                FROM " . $this->table_name . "
                WHERE username = ?
                LIMIT 0,1";
     
        
        $stmt = $this->conn->prepare( $query );
     
        
        $this->username=htmlspecialchars(strip_tags($this->username));
     
        
        $stmt->bindParam(1, $this->username);
     
        
        $stmt->execute();
     
        
        $num = $stmt->rowCount();
   
        
        if($num>0){
    
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
            
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->password = $row['password'];
     
           
            return true;
        }
     
      
        return false;
    }
     
    // update a user 
    public function update(){
     
        $password_set=!empty($this->password) ? ", password = :password" : "";
        $email_set=!empty($this->password) ? ", password = :password" : "";
        if (!empty($password_set))
        {
        $query = "UPDATE " . $this->table_name . "
                SET
                    username = :username,
                    email = :email
                    {$password_set}
                WHERE id = :id";
     
   
        $stmt = $this->conn->prepare($query);
     
     
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->email));
     
       
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
     
      
        if(!empty($this->password)){
            $this->password=htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);
        }
     
        
        $stmt->bindParam(':id', $this->id);
     
    }
    elseif(!empty($email_set))
    {
        $query = "UPDATE " . $this->table_name . "
                SET
                    username = :username
                    {$email_set}
                WHERE id = :id";
     
   
        $stmt = $this->conn->prepare($query);
     
     
        $this->username=htmlspecialchars(strip_tags($this->username));
     
       
        $stmt->bindParam(':username', $this->username);
       
     
      
        if(!empty($this->email)){
            $this->email=htmlspecialchars(strip_tags($this->email));
            $stmt->bindParam(':email', $email_set);
        }
     
        
        $stmt->bindParam(':id', $this->id);
        
    }elseif(!empty($email_set)&&!empty($email_set))
    {
        $query = "UPDATE " . $this->table_name . "
                SET
                    username = :username,
                    {$email_set}
                    {$password_set}
                WHERE id = :id";
     
   
        $stmt = $this->conn->prepare($query);
     
     
        $this->username=htmlspecialchars(strip_tags($this->username));
        
     
       
        $stmt->bindParam(':username', $this->username);
        
    
        if(!empty($this->password)&&!empty($this->email)){
            $this->password=htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);
            $this->email=htmlspecialchars(strip_tags($this->email));
            $stmt->bindParam(':email', $email_set);
        }
     
        
        $stmt->bindParam(':id', $this->id);
     
    }
        if($stmt->execute()){
            return true;
         }
        
        return false;
    }

 }
?>