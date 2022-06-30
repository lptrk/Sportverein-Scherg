<?php
include("user.php");

if($_POST["username"] && $_POST["password"] != ""){

}

class password{

    public static function verify_password($password, $username){
        $password = addslashes($this->password);
        $username = addslashes($this->username);

        if(){
            password_verify($password, );
        }
        else{
            echo "Error username does not exist";
        }
    }
}

?>