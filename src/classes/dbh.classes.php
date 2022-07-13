<?php

class Dbh
{
    //protected damit Klassen, die diese Klasse extenden auch die Methode nutzen können
    protected function connect()
    {
        //versucht den Code auszuführen, bei einem Fehler wird dieser gecatched
        try {
            $username = "root";
            $password = "Geheim01";
            //Instanz der PDO-Klasse mit Host (db-sportverein) und DB-Name (2021sportverein)
            $dbh = new PDO('mysql:host=db-sportverein;dbname=2021sportverein', $username, $password);
            //gibt die Variable dbh zurück
            return $dbh;
        } catch (PDOException $e) {
            //tritt ein Fehler bei der Verbindung auf wird eine Nachricht ausgegeben mit "Fehler: " und dann die PDO-Fehlermeldung in der $e-Variable
            print "Fehler!: " . $e->getMessage() . "<br/>";
            //Verbindung wird beendet
            die();
        }
    }

    function getAllSportstypes()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM sportart;');

        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            exit();
        }

        //Daten fetchen und in Assoziativem array erhalten
        $sports = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($sports[0] as $sport) {
            echo "<tr>";
            echo "<td>" . $sport . "</td>";
            echo "<tr>";
        }

    }

    function getAllMembers()
    {
        $pencilIcon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
</svg>';
        $deleteIcon = '<svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
  <path d="M19,4L15.5,4L14.5,3L9.5,3L8.5,4L5,4L5,6L19,6M6,19C6,20.097 6.903,21 8,21L16,21C17.097,21 18,20.097 18,19L18,7L6,7L6,19Z" style="fill:rgb(255,0,0);fill-rule:nonzero;"/>
</svg>';

        $stmt = $this->connect()->prepare('SELECT * FROM mitglied AS mi JOIN mitglied_sportart AS ms ON mi.mi_id = ms.mi_id JOIN sportart AS sp ON ms.sa_id = sp.sa_id;');

        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            exit();
        }

        //Daten fetchen und in Assoziativem array erhalten
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($members[0] as $member) {
            echo "<tr>";
            echo "<td>" . $member['vorname'] . "</td>";
            echo "<td>" . $member['nachname'] . "</td>";
            echo "<td>" . $member['plz'] . "</td>";
            echo "<td>" . $member['ort'] . "</td>";
            echo "<td>" . $member['geschlecht'] . "</td>";
            echo "<td>" . $member['abteilung'] . "</td>";
            echo "<td> <a  class='table-edit' onclick='showModal()'> " . $pencilIcon . "<a/> " . "<a class='table-edit'>" . $deleteIcon . "<a/> </td>";
            echo "<tr>";
        }

    }

}