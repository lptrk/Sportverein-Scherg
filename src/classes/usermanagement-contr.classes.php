<?php

class userManagementContr extends Dbh {

    private $name;
    private $lastname;
    private $plz;
    private $ort;
    private $gender;
    private $sport;

    public function __construct($name, $lastname, $plz, $ort, $gender, $sport) {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->plz = $plz;
        $this->ort = $ort;
        $this->gender = $gender;
        $this->sport = $sport;
    }


    public function insertMember(){
        $stmt = $this->connect()->prepare('INSERT INTO mitglied (vorname, nachname, plz, ort, geschlecht, or_id, gb_id) VALUES (?, ?, ?, ?, ?, ?, ?);');
        if(!$stmt->execute(array($this->name, $this->lastname, $this->plz, $this->ort, $this->gender, $this->sport, 1))) {
            $stmt = null;
            header("location: ../login/loginseite.php?error=stmtfailed_on_insert_member");
            exit();
    }
}

    public function updateMember(){
        $stmt = $this->connect()->prepare('UPDATE mitglied SET vorname = ?, nachname = ?, plz = ?, ort = ?, geschlecht = ?, or_id = ?, gb_id = ? WHERE vorname = ? AND nachname = ?;'); 
        if(!$stmt->execute(array($this->name, $this->lastname, $this->plz, $this->ort, $this->gender, $this->sport, 1, $this->name, $this->lastname))) {
            $stmt = null;
            header("location: ../login/loginseite.php?error=stmtfailed_on_update_member");
            exit();
        }
    }
}