<?php
session_start();

if(!isset($_SESSION["loggedin"])){
  header("location: ../login/loginseite.php?error=not_logged_in");
}

$pdo = new PDO('mysql:host=db-sportverein;dbname=2021sportverein', 'root', 'Geheim01');

$pencilIcon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
</svg>';
$deleteIcon = '<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
  <path d="M19,4L15.5,4L14.5,3L9.5,3L8.5,4L5,4L5,6L19,6M6,19C6,20.097 6.903,21 8,21L16,21C17.097,21 18,20.097 18,19L18,7L6,7L6,19Z" style="fill:rgb(255,0,0);fill-rule:nonzero;"/>
</svg>';

$sql = "SELECT vorname, nachname, plz, ort, geschlecht FROM mitglied";

$name = $_SESSION['name'];
echo $name;
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

<body id="body">
  <div class="container-div">

    <div class="top-bar">
      <section class="Nutzername" id="nutzername"><?php echo $_SESSION["name"]; ?> <a href="login/logout.php"></section>
      <section class="logout"><svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
          <path d="M14.08,15.59L16.67,13L7,13L7,11L16.67,11L14.08,8.41L15.5,7L20.5,12L15.5,17L14.08,15.59M19,3C20.097,3 21,3.903 21,5L21,9.67L19,7.67L19,5L5,5L5,19L19,19L19,16.33L21,14.33L21,19C21,20.097 20.097,21 19,21L5,21C3.89,21 3,20.1 3,19L3,5C3,3.89 3.89,3 5,3L19,3Z" style="fill:url(#_Linear1);fill-rule:nonzero;" />
          <defs>
            <linearGradient id="_Linear1" x1="0" y1="0" x2="1" y2="0" gradientUnits="userSpaceOnUse" gradientTransform="matrix(18,0,0,18,3,12)">
              <stop offset="0" style="stop-color:rgb(88,88,88);stop-opacity:1" />
              <stop offset="0.47" style="stop-color:rgb(119,84,84);stop-opacity:1" />
              <stop offset="1" style="stop-color:rgb(201,74,74);stop-opacity:1" />
            </linearGradient>
          </defs>
        </svg>
        </a></section>
    </div>

    <div class="ueberschrift">MITGLIEDERVERWALTUNG</div>
    <button class="mitglied-hinzufuegen">
      <a class="hinzufuegen-button" onclick="openAddModal()">+ Mitglied hinzufügen</a>
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
          <th>Gechlecht</th>
          <th>Sportart</th>
          <th class="table-aktionen">Aktionen</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($pdo->query($sql) as $row) {
          echo "<tr>";
          echo "<td>" . $row['vorname'] . "</td>";
          echo "<td>" . $row['nachname'] . "</td>";
          echo "<td>" . $row['plz'] . "</td>";
          echo "<td>" . $row['ort'] . "</td>";
          echo "<td>" . $row['geschlecht'] . "</td>";
          echo "<td>" . $row['geschlecht'] . "</td>";
          echo "<td> <a  class='table-edit' onclick='showModal()'> " . $pencilIcon . "<a/> " . "<a class='table-edit'>" . $deleteIcon . "<a/> </td>";
          echo "<tr>";
        }
        ?>
      <tfoot class="table-footer">
        <tr class="footer-row">
          <td>Ergebnisse pro Seite
          </td>
          <td> <select name="" id="ergebnisse-pro-seite">
              <option value="">10</option>
            </select>
          </td>
          <td></td>
          <td></td>
          <td>Aktuelle Seite</td>
          <td><select name="" id="">
              <option value="">1</option>
            </select></td>
        </tr>
      </tfoot>
      </tbody>
    </table>
  </div>
  </div>


  <!-- PopUp Windows -->

  <!-- Fenster, in dem Mitglieder bearbeitet werden können -->

  <form action="">
    <div class="edit-div" id="edit-div">
      <div class="edit-header">
        MITGLIED BEARBEITEN
      </div>
      <section class="edit-underline"></section>
      <label for="name" class="name-label">Vorname*</label>
      <input type="text" id="name">
      <label for="lastname" class="lastname-label">Nachname*</label>
      <input type="text" id="lastname">
      <label for="plz" class="plz-label">PLZ*</label>
      <input type="text" id="plz">
      <label for="ort" class="ort-label">Ort*</label>
      <input type="text" id="ort">
      <label for="geschlecht" class="geschlecht-label">Geschlecht*</label>
      <select id="geschlecht">
        <option value="male">Männlich</option>
        <option value="female">Weiblich</option>
      </select>
      <label for="sportarten" class="sportarten-label">Sportarten*</label>
      <select name="sportarten" id="sportarten">
        <option value="">Sportart auswählen</option>
      </select>
      <div class="add-member">
        <button type="button" class="add-text" onclick="closeModal()">BESTÄTIGEN</button>
      </div>
    </div>
  </form>

  <!-- Fenster, um Mitglieder hinzuzufügen -->
  <form action="">
    <div class="edit-div" id="add-div">
      <div class="edit-header">
        MITGLIED HINZUFÜGEN
      </div>
      <section class="edit-underline"></section>
      <label for="name" class="name-label">Vorname*</label>
      <input type="text" id="name">
      <label for="lastname" class="lastname-label">Nachname*</label>
      <input type="text" id="lastname">
      <label for="plz" class="plz-label">PLZ*</label>
      <input type="text" id="plz">
      <label for="ort" class="ort-label">Ort*</label>
      <input type="text" id="ort">
      <label for="geschlecht" class="geschlecht-label">Geschlecht*</label>
      <select id="geschlecht">
        <option value="male">Männlich</option>
        <option value="female">Weiblich</option>
      </select>
      <label for="sportarten" class="sportarten-label">Sportarten*</label>
      <select name="sportarten" id="sportarten">
        <option value="">Sportart auswählen</option>
      </select>
      <div class="add-member">
        <button type="button" class="add-text" onclick="closeAddModal()">HINZUFÜGEN</button>
      </div>
    </div>
  </form>

  <!-- Delete Warnung -->

  <div class="delete-message-div">

  </div>

  <script type="text/javascript" src="mitgliederverwaltung.js"></script>
</body>

</html>