<?php

$dbh = new PDO('mysql:host=db-sportverein;dbname=2021sportverein', 'root', 'Geheim01');
$sql = "SELECT name, password FROM user";

class user{
    private $username;
    private $password;

    function __construct($username){
        $this->username = $username;
    }

    function getPassword(){

        $sql = "SELECT password FROM user";
        return $this->password;
    }

    public function user_exists($username){
        //Datenbankverbindung aufbauen und SQL statement -> ergebnis in variable speichern
        $dbh = new PDO('mysql:host=db-sportverein;dbname=2021sportverein', 'root', 'Geheim01');
        $sql = "SELECT id FROM user WHERE name = '".$username."'";
        $ergebnis = $dbh->query($sql);

        if($ergebnis != NULL){
            echo "erfolg";
        } else{
            echo "fehler";
        }
    }
}

$user = new user("Maxuster");
$user->user_exists("Maxuster");

?>