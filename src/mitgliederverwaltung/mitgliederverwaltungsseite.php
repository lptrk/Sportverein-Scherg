<?php

if(isset($_POST["addMember"])){

    //Daten holen
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $postcode = $_POST["plz"];
    $location = $_POST["ort"];
    $gender = $_POST["geschlecht"];
    $sporttype = $_POST["sportarten"];

    //userManagementContr instanziieren
    include "../classes/dbh.classes.php";
    include "../classes/usermanagement.classes.php";
    include "../classes/usermanagement-contr.classes.php";
    $userManagement = new userManagementContr($name, $lastname, $postcode, $location, $gender, $sporttype);

    //Funktionen
    $userManagement->addMember();

    //Zur Übersichtsseite
    header("location: ../login/loginseite.php?error=no_error");

}