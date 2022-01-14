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
    public $cards;
    public $winner;
    public $uturn;
    // constructor $db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function gettrun()
    {

        $query = "SELECT u.username
        FROM " . $this->table_name4 . " a
        JOIN " . $this->table_name5 . " u on a.playerturn=u.id
        where roomid = ?;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            $this->uturn = $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
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

            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->id = $row['id'];
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    function joinroom() //f
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
        WHERE id  = ? and user2 = 0 AND NOT user1 = ? AND NOT user2 = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(2,  $this->idu);
            $stmt->bindParam(1, $this->id);
            $stmt->bindParam(3,  $this->idu);
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
    function startgame() //f
    {
        $query = "SELECT user1 , user2
        FROM " . $this->table_name3 . "
        WHERE id  = ?";
        $stmt = $this->conn->prepare($query);


        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "SELECT roomid
        FROM " . $this->table_name4 . "
        WHERE roomid  = ?";
        $stmt = $this->conn->prepare($query);


        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        $stmt->execute();
        $l = $stmt->rowCount();
        if ($l == 0 && ($user['user1'] > 0 && $user['user2'] > 0)) {
            $query = "INSERT INTO " . $this->table_name4 . "
               (roomid, playerturn, gamestatus)
                        VALUES (
                         ?,
                         ?,
                         1
                     );";

            $stmt = $this->conn->prepare($query);


            $stmt->bindParam(1, $this->id);
            $stmt->bindParam(2, $user['user1']);

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
                for ($i = 1; $i <= $num; $i++) {
                    $card_id = implode(", ", $cards[$i]);
                    // echo  $card_id;
                    if ($i <= 21) {
                        $query = "INSERT INTO " . $this->table_name . "
                             SET
                             user_id = :user_id,
                             card_id = :card_id";

                        $stmt = $this->conn->prepare($query);



                        $stmt->bindParam(':user_id', $user['user1']);
                        $stmt->bindParam(':card_id', $card_id);
                        $stmt->execute();
                    } else {
                        $query = "INSERT INTO " . $this->table_name . "
                                SET
                                user_id = :user_id,
                                card_id = :card_id";

                        $stmt = $this->conn->prepare($query);



                        $stmt->bindParam(':user_id', $user['user2']);

                        $stmt->bindParam(':card_id', $card_id);
                        $stmt->execute();
                    }
                }
                return true;
            } else {
                return false;
            }
        }
    }
    function dropcards() //f
    {
        $query = "SELECT playerturn
        FROM " . $this->table_name4 . "
        WHERE roomid = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {

            $player = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($this->idu == $player["playerturn"]) {
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
                        while ($flag && $j <= $num) {
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
                        // echo $pcrads[$i];
                        $stmt->bindParam(1, $card);

                        $stmt->execute();
                    }
                }

                
                return true;
            } else {
                return false;
            }
        }
    }
    function selectrandom() //f
    {

        $query = "SELECT playerturn
        FROM " . $this->table_name4 . "
        WHERE roomid = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $player1 = $stmt->fetch(PDO::FETCH_ASSOC);
        $query = "SELECT user1,user2
        FROM " . $this->table_name3 . "
        WHERE id = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $players = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($player1);
        if ($this->idu == $player1["playerturn"]) {
            if (!($player1['playerturn'] == $players['user1'])) {
                $player2 = $players['user1'];
            } else {
                $player2 = $players['user2'];
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
            $l1 = rand(1, $num);

            // print_r($cards[$l1]);
            $query = "UPDATE " . $this->table_name . "
            SET user_id = ?
            WHERE card_id = ?";
            $stmt = $this->conn->prepare($query);
            $card = implode(", ", $cards[$l1]);

            $stmt->bindParam(2, $card);
            $stmt->bindParam(1, $player1['playerturn']);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function showdeck() //f
    {
        $query = "SELECT p.user_id , c.v , c.c
        FROM " . $this->table_name . " p
        JOIN " . $this->table_name2 . " c ON p.card_id = c.id";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            $num = $stmt->rowCount();

            for ($i = 1; $i <= $num; $i++) {
                $this->cards[$i] = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return true;
        } else {
            return false;
        }
    }
    function getwinner() //F
    {

        $query = "SELECT c.v ,p.user_id 
        FROM " . $this->table_name . " p
        JOIN " . $this->table_name2 . " c ON p.card_id = c.id";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            $card = $stmt->fetch(PDO::FETCH_ASSOC);
            $num = $stmt->rowCount();

            if ($num == 1 && $card['v'] == "K") {
                $query = " UPDATE " . $this->table_name4 . "
                     SET gamestatus = 2
                     WHERE roomid = ?
                                   ";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1, $this->id);
                $stmt->execute();

                $query = "SELECT u.username ,u.id
                            FROM " . $this->table_name3 . " r
                            join " . $this->table_name5  . " u on r.user1=u.id or r.user2=u.id 
                            where r.id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1, $this->id);

                if ($stmt->execute()) {
                    $users[1] = $stmt->fetch(PDO::FETCH_ASSOC);
                     $users[2] = $stmt->fetch(PDO::FETCH_ASSOC);
                    // print_r($users);
                    if (!($card['user_id'] == $users[1]['id'])) {
                        $this->winner = $users[1]['username'];
                    } else{
                        $this->winner = $users[2]['username'];
                    }

                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
    }
    function changeturn()
    {


        $query = "SELECT playerturn
        FROM " . $this->table_name4 . "
        WHERE roomid = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $player1 = $stmt->fetch(PDO::FETCH_ASSOC);
        $query = "SELECT user1,user2
        FROM " . $this->table_name3 . "
        WHERE id = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $players = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($player1);
        if ($this->idu == $player1["playerturn"]) {
            if (!($player1['playerturn'] == $players['user1'])) {
                $player2 = $players['user1'];
            } else {
                $player2 = $players['user2'];
            }

            $query = " UPDATE " . $this->table_name4 . "
                     SET playerturn = ?
                     WHERE roomid = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $player2);
            $stmt->bindParam(2, $this->id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {

            return false;
        }
        return false;
    }
    function leavegame()
    {
        $query = "SELECT user1,user2
        FROM " . $this->table_name3 . "
        WHERE id = ? ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $players = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($this->idu == $players["user1"]) {
            $query = " UPDATE " . $this->table_name3 . "
                     SET user1 = 0
                     WHERE id = ?";
            $stmt = $this->conn->prepare($query);
       
            $stmt->bindParam(1, $this->id);
            }elseif($this->idu == $players["user2"]){
                 $query = " UPDATE " . $this->table_name3 . "
                     SET user2 = 0
                     WHERE id = ?";
            $stmt = $this->conn->prepare($query);
           
            $stmt->bindParam(1, $this->id);
            
            }else
            {
                return false;
            }
            if ($stmt->execute()) {
                $query = "DELETE
                FROM " . $this->table_name . "";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                if ($stmt->execute()){
                    $query = "DELETE
                    FROM " . $this->table_name4 . "
                    where roomid= ?";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(1, $this->id);
                    if ($stmt->execute()){
                return true;
                }else {
                    return false;}
                return true;
            } else {
                return false;}
            } else {
                return false;
            }
        }
    
}
