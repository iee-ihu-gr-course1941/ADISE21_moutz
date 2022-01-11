<?php

class Game
{

    // db connection and table name
    private $conn;
    private $table_name5 = "users";
    private $table_name = "playercards";
    private $table_name2 = "cards";
    private $table_name3 = "room";
    private $table_name4 = "activerooms";
    // object
    public $lobby;
    public $users;
    public $idu;
    public $id;
    public $deck;
    // constructor $db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getallrooms() //f
    {

        $query = "SELECT r.id, u.username
        FROM " . $this->table_name3 . " r
        LEFT  JOIN " . $this->table_name5 . " u on r.user1=u.id or r.user2=u.id;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        for ($i = 1; $i <= $num; $i++) {


            $this->lobby[$i] = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return true;
    }
    function createroom() //f
    {

        $query = "SELECT user1 , user2
        FROM " . $this->table_name3 . "
        WHERE user1  = ? OR user2  = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->idu);
        $stmt->bindParam(2, $this->idu);

        $stmt->execute();

        $num = $stmt->rowCount();
        if (!$num > 0) {
            $query = "INSERT INTO " . $this->table_name3 . "
              SET
             user1 = :user1";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':user1', $this->idu);

            $stmt->execute();

            $query = "SELECT id 
            FROM " . $this->table_name3 . "
            WHERE user1  = ? ";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->idu);

            if($stmt->execute())
            {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            return true;
            }else
            {
                return false;
            }
        }
        return false;
    }
    function joinroom()//f
    {
        $query = "SELECT id
        FROM " . $this->table_name3 . "
        WHERE id  = ? AND user1 = 0 ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {

            $query = "UPDATE " . $this->table_name3 . "
                                SET user1 = ?
                                WHERE id = ?";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1,  $this->idu);
            $stmt->bindParam(2,  $this->id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
        
            $query = "SELECT id
        FROM " . $this->table_name3 . "
        WHERE id  = ? and user2 = 0 AND NOT user2 = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(2,  $this->idu);
            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $num = $stmt->rowCount();
            
            if ($num > 0) {
                
                $query = "UPDATE " . $this->table_name3 . "
                                SET user2 = ?
                                WHERE id = ?";

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(1,  $this->idu);
                $stmt->bindParam(2,  $this->id);
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else
                return false;
        }
    }
    function startgame() //f?
    {
        $query = "SELECT user1 , user2
        FROM " . $this->table_name3 . "
        WHERE id  = ?";
        $stmt = $this->conn->prepare($query);


        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        $stmt->execute();
        $user[1] = $stmt->fetch(PDO::FETCH_ASSOC);
        $user[2] = $stmt->fetch(PDO::FETCH_ASSOC);
        $userid1 = implode(", ", $user[1]);
        $query = "UPDATE " . $this->table_name4 . "
                    SET
                    gamestatus = 1
                     WHERE roomid = ?";


        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            $cards = [];

            $query = "SELECT id
                     FROM " . $this->table_name2 . "";

            $stmt = $this->conn->prepare($query);


            $stmt->execute();

            $num = $stmt->rowCount();

            for ($i = 1; $i <= $num; $i++) {


                $cards[$i] = $stmt->fetch(PDO::FETCH_ASSOC);
            }


            for ($i = 1; $i <= 500; $i++) {
                $l1 = rand(1, $num);
                $l2 = rand(1, $num);
                $tmp = $cards[$l1];
                $cards[$l1] = $cards[$l2];
                $cards[$l2] = $tmp;
            }
            $uid1 = $userid1[0];

            $uid2 = $userid1[3];
            for ($i = 1; $i <= $num; $i++) {
                $card_id = implode(", ", $cards[$i]);
                // echo  $card_id;
                if ($i <= 21) {
                    $query = "INSERT INTO " . $this->table_name . "
                             SET
                             user_id = :user_id,
                             card_id = :card_id";

                    $stmt = $this->conn->prepare($query);



                    $stmt->bindParam(':user_id', $uid1);
                    $stmt->bindParam(':card_id', $card_id);
                    $stmt->execute();
                } else {
                    $query = "INSERT INTO " . $this->table_name . "
                                SET
                                user_id = :user_id,
                                card_id = :card_id";

                    $stmt = $this->conn->prepare($query);



                    $stmt->bindParam(':user_id', $uid2);

                    $stmt->bindParam(':card_id', $card_id);
                    $stmt->execute();
                }
            }
            $query = "INSERT INTO " . $this->table_name4 . "
                              (roomid  , playerturn ) 
                                SELECT id ,user1
                                FROM " . $this->table_name3 . "
                                WHERE user1  = ? AND user2  = ?;
                               ";

            $stmt = $this->conn->prepare($query);


            $stmt->bindParam(1, $uid1);
            $stmt->bindParam(2, $uid2);

            $stmt->execute();
            $query = " SELECT id 
            FROM " . $this->table_name3 . "
            WHERE user1  = ?";
            $stmt = $this->conn->prepare($query);


            $stmt->bindParam(1, $uid1);

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            return true;
        }


        return false;
    }
    function dropcards()
    {
        $query = "SELECT playerturn
        FROM " . $this->table_name4 . "
        WHERE roomid = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $player = $stmt->fetch(PDO::FETCH_ASSOC);


        $query = "SELECT card_id
       FROM " . $this->table_name . "
       WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $player["playerturn"]);

        $stmt->execute();
        $num = $stmt->rowCount();

        $cards = [];
        for ($i = 1; $i <= $num; $i++) {
            $cards[$i] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        // print_r( $cards);
        $pcrads = [];
        for ($i = 1; $i <= $num; $i++) {
            $query = "SELECT v
        FROM " . $this->table_name2 . "
        WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            $card = implode(", ", $cards[$i]);
            //   echo $card;                              
            $stmt->bindParam(1, $card);

            $stmt->execute();
            $pcradsid = $stmt->fetch(PDO::FETCH_ASSOC);
            $pcrads[$i] = $pcradsid;
        }
        // print_r($pcrads);
        for ($i = 1; $i <= $num; $i++) {
            if (!($pcrads[$i] == 0)) {
                $flag = true;
                $j = $i + 1;
                while ($flag && $j < $num) {
                    // print_r($pcrads[$j] == $pcrads[$i]);
                    // echo "/n";
                    if ((($pcrads[$j] == $pcrads[$i]))) {
                        $flag = false;
                        // print_r($pcrads[$j]);
                        // print_r($pcrads[$i]);
                        $pcrads[$j] = 0;
                        $pcrads[$i] = 0;
                        $j++;
                    }
                    $j++;
                }
            }
        }
        // print_r($pcrads);
        // echo "    ";

        for ($i = 1; $i <= $num; $i++) {
            if ($pcrads[$i] == 0) {

                $query = "DELETE FROM " . $this->table_name . "
                WHERE card_id = ?";
                $stmt = $this->conn->prepare($query);
                $card = implode(", ", $cards[$i]);
                echo $pcrads[$i];
                $stmt->bindParam(1, $card);

                $stmt->execute();
            } else {
            }
        }
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function selectrandom()
    {

        $query = "SELECT playerturn
        FROM " . $this->table_name4 . "
        WHERE roomid = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $player = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($player["playerturn"] == $this->user1) {
            $player2 = $this->user1;
        } else {
            $player = $this->user2;
        }
        $query = "SELECT card_id
        FROM " . $this->table_name . "
        WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $player2);

        $stmt->execute();
        $num = $stmt->rowCount();

        $cards = [];
        for ($i = 1; $i <= $num; $i++) {
            $cards[$i] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        // print_r( $cards);
        $pcrads = [];
        for ($i = 1; $i <= $num; $i++) {
            $query = "SELECT v
     FROM " . $this->table_name2 . "
        WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            $card = implode(", ", $cards[$i]);
            //   echo $card;                              
            $stmt->bindParam(1, $card);

            $stmt->execute();
            $pcradsid = $stmt->fetch(PDO::FETCH_ASSOC);
            $pcrads[$i] = $pcradsid;
        }
        $flag = true;

        while ($flag) {

            $l1 = rand(1, $num);
            for ($i = 1; $i <= $num; $i++) {
                if ($l1 == implode(", ", $pcrads[$i])) {
                    $flag = false;
                }
            }
        }


        $query = "UPDATE " . $this->table_name . "
            SET user_id = ?
            WHERE card_id = ?";
        $stmt = $this->conn->prepare($query);
        $card = implode(", ", $cards[$l1]);

        $stmt->bindParam(2, $card);
        $stmt->bindParam(1, $player["playerturn"]);
        $stmt->execute();

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function showdeck()
    {
        $query = "SELECT card_id
        FROM " . $this->table_name . "
        WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->idu);

        $stmt->execute();
        $num = $stmt->rowCount();

        $cards = [];
        for ($i = 1; $i <= $num; $i++) {
            $cards[$i] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        // print_r( $cards);
        $pcrads = [];
        for ($i = 1; $i <= $num; $i++) {
            $query = "SELECT 
         FROM " . $this->table_name2 . "
         WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            $card = implode(", ", $cards[$i]);
            //   echo $card;                              
            $stmt->bindParam(1, $card);

            $stmt->execute();
            $pcradsid = $stmt->fetch(PDO::FETCH_ASSOC);
            $pcrads[$i] = $pcradsid;
        }
        $this->deck = $pcrads;
        return true;
    }
}
