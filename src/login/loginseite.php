<?php
    session_start();
    //Hier nur mal eben einen Benutzer in die Datenbank geshitfixed (später code hier löschen?)

/*    $name = 'Mustermann';
    $password = 'geheim';
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $test = new loginContr($name, $password);
    $test->hashPassword($name, $password);*/

    //Nur Zum testen
    /*if(isset($_SESSION["username"])){
        echo $_SESSION["username"];
        echo $_SESSION["userid"];
    }*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <div class="header">SPORTVEREIN</div>
    <div class="line"></div>
    <div class="login-form">
      <form action="login.php" method="post">
        <label class="label-username" for="username">Benutzername</label>
        <input class="username" type="text" name="username" />
        <label class="label-password" for="password">Passwort</label>
        <input class="password" type="password" name="password" />
        <input class="submit" type="submit" name="submit" placeholder="LOGIN" />
      </form>
    </div>
   
<div class="background-div">
  <img src="../assets/hintergrundbild.png" alt="" class="background-image">
</div>
    </body>
</html>
