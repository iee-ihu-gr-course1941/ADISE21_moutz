<?php

class Friend{
 
    // db connection and table name
    private $conn;
    private $table_name = "friends";
    private $table_helper = "users";
 
    // object
    public $id_senter;
    public $id_receiver;
    public $accepted;
 
    // constructor $db connection
    public function __construct($db){
        $this->conn = $db;
    }

    //user signup method
    function addfriend(){
    //     $query = "SELECT id
    //            FROM " . $this->table_helper . "
    //            WHERE username = ?
    //            LIMIT 0,1";
    
       
    //    $stmt = $this->conn->prepare( $query );
    
       
    //    $this->username=htmlspecialchars(strip_tags($this->username));
    
       
    //    $stmt->bindParam(1, $this->username);
    
       
    //    $stmt->execute();
    
    //    $num = $stmt->rowCount();
       
    //    if(!$num>0){
      
       $query = "INSERT INTO " . $this->table_name . "
               SET
                  id_senter = :id_senter,
                  id_receiver = :id_receiver";
    
               
       $stmt = $this->conn->prepare($query);
    
       $this->id_senter=htmlspecialchars(strip_tags($this->id_senter));
       $this->id_receiver=htmlspecialchars(strip_tags($this->id_receiver));
      

       $stmt->bindParam(':id_senter', $this->id_senter);
       $stmt->bindParam(':id_receiver', $this->id_receiver);
     
    
       if($stmt->execute()){
           return true;
       }
//    }
       return false;
   }
}
?>