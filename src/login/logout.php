<?php

//session starten damit wir sie entfernen können
session_start();
//variablen unsetten
session_unset();
//session entfernen
session_destroy();

header("Location: ../login/loginseite.php?error=none");