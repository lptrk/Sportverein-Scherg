<?php

class userManagementContr extends userManagement {

    private $name;
    private $lastname;
    private $postcode;
    private $location;
    private $gender;
    private $sporttype;

    public function __construct($name, $lastname, $postcode, $location, $gender, $sporttype) {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->postcode = $postcode;
        $this->location = $location;
        $this->gender = $gender;
        $this->sporttype = $sporttype;
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