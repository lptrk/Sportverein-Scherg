<?php

$dbh = new PDO('mysql:host=db-sportverein;dbname=2021sportverein', 'sportverein', 'sportverein');
/* $db = mysqli_connect(
    "127.0.0.1",
    "sportverein",
    "sportverein",
    "2021sportverein"    
);*/

class user{
    private $username;
    private $password;
    public $dbh;

    function __construct($username, $dbh){
        $this->username = $username;
        $this->dbh = $dbh;
    }

    function getPassword(){
        return $this->password;
    }

    function setPassword(){ //add sql injec

    }

    public function user_exist($username){
        $sql = "SELECT id FROM user WHERE username = '".$username."';";
        $ergebnis = $dbh->query($sql);

        if($ergebnis == true){
            echo "erfolg";
        }
        else{
            echo "fehler";
        }
    }
}

$user = new user("sportverein");
$user->user_exist("sportverein");

?>