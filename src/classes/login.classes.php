<?php

class Login extends Dbh {

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

            if(!$stmt->execute(array($name, $password))) {
                $stmt = null;
                header("location: ../login/loginseite.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../login/loginseite.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] = $user[0]["id"];
            $_SESSION["username"] = $user[0]["name"];
            //["userid"] = "1";
            //$_SESSION["username"] = "Mustermann";

        }

        $stmt = null;
    }

    public function hashPassword($name, $password){
        $stmt = $this->connect()->prepare('INSERT INTO user (name, password) VALUES (?, ?);');

        //Passwort wird gehashed (maskiert) mit dem Algorithmus "PASSWORD_DEFAULT"
        $hashedPw = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($name, $hashedPw))) {
            //stmt löschen
            $stmt = null;
            header("location: ../login/loginseite.php?error=stmtfailed");
            //script verlassen
            exit();
        }
        $stmt = null;
    }

}