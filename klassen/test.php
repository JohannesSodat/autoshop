<?php

    require_once("user.class.php"); 
    require_once("mitarbeiter.class.php");
    require_once("admin.class.php");
    require_once("produkte.class.php");
    require_once("auto.class.php");

    $user = new User(1, "Herr", "Eisberg", "Superstraße 13", "1234", "12.01.2024", "Peter", "Müller");


?>
