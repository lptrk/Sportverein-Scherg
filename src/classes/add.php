<?php

include "usermanagement.classes.php";

if(isset($_POST["name"], $_POST["lastname"], $_POST["plz"], $_POST["ort"], $_POST["geschlecht"], $_POST["sportarten"])){
        userManagement:insertMember($_POST["name"], $_POST["lastname"], $_POST["plz"], $_POST["ort"], $_POST["geschlecht"], $_POST["sportarten"]);
    }else{
        header("location: ../mitgliederverwaltung/mitgliederverwaltung.php?error=no_values_given");
        exit();
    }

?>