<?php

class userManagement extends Dbh {

    protected function insertMember($name, $lastname, $plz, $ort, $gender, $sport){
        $stmt = $this->connect()->prepare('INSERT INTO mitglied (vorname, nachname, plz, ort, geschlecht, or_id, gb_id) VALUES (?, ?, ?, ?, ?, ?, ?);');
        if(!$stmt->execute(array($name, $lastname, $plz, $ort, $gender, $sport, 1))) {
            $stmt = null;
            header("location: ../login/loginseite.php?error=stmtfailed_on_insert_member");
            exit();
    }
}
//$sql = "SELECT * FROM mitglied AS mi JOIN mitglied_sportart AS ms ON mi.mi_id = ms.mi_id JOIN sportart AS sp ON ms.sa_id = sp.sa_id";

    protected function updateMember($name, $lastname, $plz, $ort, $gender, $sport){
        $stmt = $this->connect()->prepare('UPDATE mitglied SET vorname = ?, nachname = ?, plz = ?, ort = ?, geschlecht = ?, or_id = ?, gb_id = ? WHERE vorname = ? AND nachname = ?;'); 
        if(!$stmt->execute(array($name, $lastname, $plz, $ort, $gender, $sport, 1, $name, $lastname))) {
            $stmt = null;
            header("location: ../login/loginseite.php?error=stmtfailed_on_update_member");
            exit();
        }
    }

    protected function getSports(){

    }

    protected function getUser($name, $password) {
        $stmt = $this->connect()->prepare('SELECT password FROM user WHERE name = ?;');

        if(!$stmt->execute(array($name))) { //ToDo
            $stmt = null;
            header("location: ../login/loginseite.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../login/loginseite.php?error=stmtfailed");
            exit();
        }

        //Daten fetchen und in Assoziativem array erhalten
        $hashedPw = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPw = password_verify($password, $hashedPw[0]['password']);

        if($checkPw == false) {
            $stmt = null;
            header("location: ../login/loginseite.php?error=wrongpassword");
            exit();
        }elseif ($checkPw == true) {
            $stmt = $this->connect()->prepare('SELECT password FROM user WHERE name = ? AND password = ?;');

            if(!$stmt->execute(array($name, $hashedPw[0]['password']))) {
                $stmt = null;
                header("location: ../login/loginseite.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0) { //Todo
                $stmt = null;
                header("location: ../login/loginseite.php?error=usernotfound");
                exit();
            }

            $user = $this->connect()->prepare('SELECT * FROM user WHERE name = ? AND password = ?;');
            $user->execute(array($name, $hashedPw[0]['password']));
            $users = $user->fetchAll();
            //$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $users[0]["id"];
            $_SESSION["username"] = $users[0]["name"];
            $_SESSION["loggedin"] = true;
            //["userid"] = "1";
            //$_SESSION["username"] = "Mustermann";

        }

        $stmt = null;
    }

}
