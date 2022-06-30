<?php
$pdo = new PDO('mysql:host=db-sportverein;dbname=2021sportverein', 'root', 'Geheim01');

$sql = "SELECT vorname, nachname, plz, ort, geschlecht FROM mitglied";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/mitgliederverwaltung/mitgliederverwaltung.css" />
    <title>Mitgliederverwaltung</title>
  </head>
  <body>
    <div class="top-bar">
      <section class="Nutzername">Name des Benutzers</section>
    </div>

    <div class="ueberschrift">MITGLIEDERVERWALTUNG</div>
      <button class="mitglied-hinzufuegen">
        <a class="hinzufuegen-button" href="">+ Mitglied hinzufügen</a>
      </button>
      <input type="text" class="Freitextsuche" placeholder="Freitextsuche">
    </div>
    <section class="strich"></section>
    <div class="bottom-bar">
      <section class="bottom-text">Sportverein © 2022</section>
    </div>
    <div class="table-div">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Vorname</th>
                    <th>Name</th>
                    <th>Postleitzahl</th>
                    <th>Ort</th>
                    <th>Sportart</th>
                    <th>Aktionen</th>
                    <th>Adresse</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($pdo->query($sql) as $row) {
                echo "<tr>";
                echo "<td>" . $row['vorname']."</td>";
                echo "<td>" . $row['nachname']."</td>";
                echo "<td>" . $row['plz']."</td>";
                echo "<td>" . $row['ort']."</td>";
                echo "<td>" . $row['geschlecht']."</td>";
                echo "<tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
  </body>
</html>
