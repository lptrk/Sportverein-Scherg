<?php

class loginContr extends Login {

    private $name;
    private $password;

    public function __construct($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }

    public function loginUser() {
        if($this->emptyInput() == false) {
            header("location: ../login/loginseite.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->name, $this->password);
    }

    public function emptyInput(){
        if(empty($this->name) || empty($this->password)) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

}