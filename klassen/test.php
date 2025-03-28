<?php

    require_once("user.class.php"); 
    require_once("mitarbeiter.class.php");
    require_once("admin.class.php");
    require_once("produkte.class.php");
    require_once("auto.class.php");

    // User anlegen
    $user = new User(1, "Herr", "standard", "Herrengasse 2", "test123", "12.01.1985", "Peter", "Hans");

    // Mitarbeiter anlegen
    $mitarbeiter = new Mitarbeiter(2, "Frau", "blau", "Gasse 5", "passwort456", "05.07.1990", "Anna", "Schmidt", 3500.50, "Entwickler");

    // Admin anlegen
    $admin = new Admin(3, "Herr", "rot", "Platz 10", "adminpass", "23.03.1980", "Max", "Müller", "secureAdminPW");

    // Ausgabe der Daten
    echo "User: " . $user->getAnrede() . " " . $user->getVorname() . " " . $user->getNachname() . ", Geburtsdatum: " . $user->getGeburtsdatum() . "<br>";
    echo "Mitarbeiter: " . $mitarbeiter->getAnrede() . " " . $mitarbeiter->getVorname() . " " . $mitarbeiter->getNachname() . ", Geburtsdatum: " . $mitarbeiter->getGeburtsdatum() . ", Stelle: " . $mitarbeiter->getStelle() . ", Gehalt: " . $mitarbeiter->getGehalt() . "€<br>";
    echo "Admin: " . $admin->getAnrede() . " " . $admin->getVorname() . " " . $admin->getNachname() . ", Geburtsdatum: " . $admin->getGeburtsdatum() . "<br>";

    $auto = new Auto("Tesla Model 3", 45000.99, "Elektrofahrzeug", 10, "Tesla", "2025-06-30", "M-AB-1234", 15000, "Model 3");

    echo "Auto erstellt: \n";
    echo "Name: " . $auto->getPname() . "\n";
    echo "Preis: " . $auto->getPreis() . " €\n";
    echo "Bezeichnung: " . $auto->getBezeichnung() . "\n";
    echo "Bestand: " . $auto->getBestand() . "\n";
    echo "Marke: " . $auto->getMarke() . "\n";
    echo "Plakette gültig bis: " . $auto->getPlakette() . "\n";
    echo "Kennzeichen: " . $auto->getKennzeichen() . "\n";
    echo "Kilometerstand: " . $auto->getKmStand() . " km\n";
    echo "Modell: " . $auto->getModel() . "\n";





?>
