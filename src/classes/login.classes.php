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

    public function hashPassword($name, $password){
        $stmt = $this->connect()->prepare('INSERT INTO user (name, password) VALUES (?, ?);');

        //Passwort wird gehashed (maskiert) mit dem Algorithmus "PASSWORD_DEFAULT"
        $hashedPw = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($name, $hashedPw))) {
            //stmt l??schen
            $stmt = null;
            header("location: ../login/loginseite.php?error=stmtfailed");
            //script verlassen
            exit();
        }
        $stmt = null;
    }

}