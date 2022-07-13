<?php
include "../classes/dbh.classes.php";
include "../classes/usermanagement.classes.php";
include "../classes/usermanagement-contr.classes.php";

if($_POST["action"] == "add_member"){

    //Daten holen
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $plz = $_POST["plz"];
    $ort = $_POST["ort"];
    $gender = $_POST["geschlecht"];
    $sport = $_POST["sportarten"];

    //userManagementContr instanziieren
    $userManagement = new userManagementContr($name, $lastname, $plz, $ort, $gender, $sport);

    //Funktionen
    $userManagement->addMember();

    //Zur Übersichtsseite
    header("location: ../login/loginseite.php?error=no_error");

}else if($_POST["action" == "update_member"]){
    //Daten holen
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $plz = $_POST["plz"];
    $ort = $_POST["ort"];
    $gender = $_POST["geschlecht"];
    $sport = $_POST["sportarten"];   
   
    //userManagementContr instanziieren
    $userManagement = new userManagementContr($name, $lastname, $plz, $ort, $gender, $sport);

    //Funktionen
    $userManagement->setMember();

    //Zur Übersichtsseite
    header("location: ../login/loginseite.php?error=no_error");
}