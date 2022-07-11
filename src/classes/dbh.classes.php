<?php

class Dbh {
    //protected damit Klassen, die diese Klasse extenden auch die Methode nutzen können
    protected function connect() {
        try{
            $username = "root";
            $password = "Geheim01";
            //Instanz der PDO-Klasse mit Host (db-sportverein) und DB-Name (2021sportverein)
            $dbh = new PDO('mysql:host=db-sportverein;dbname=2021sportverein', $username, $password);
            //gibt die Variable dbh zurück
            return $dbh;
        }
        catch (PDOException $e) {
            //tritt ein Fehler bei der Verbindung auf wird eine Nachricht ausgegeben mit "Fehler: " und dann die PDO-Fehlermeldung in der $e-Variable
            print "Fehler!: " . $e->getMessage() . "<br/>";
            //Verbindung wird beendet
            die();
        }
    }

}