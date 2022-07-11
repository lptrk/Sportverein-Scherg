<?php
if(isset($_POST["submit"])){

    //Daten holen
    $name = $_POST["username"];
    $password = $_POST["password"];

    //Login-Controller Instanz erstellen
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new loginContr($name, $password);

    //Error Handler und LoginContr
    $login->loginUser();

    //Zur Hauptseite
    header("location: ../mitgliederverwaltung/mitgliederverwaltung.php?error=none");
}