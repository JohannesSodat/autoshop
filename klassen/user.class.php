<?php

class User {

    // Attribute 
    private $user_ID;
    private $anrede; 
    private $bg_color; 
    private $adresse; 
    private $passwort; 
    private $geburtsdatum; 
    private $vorname; 
    private $nachname; 

    // Konstruktor mit Parametern
    public function __construct(int $user_ID, string $anrede, string $bg_color, string $adresse, string $passwort, string $geburtsdatum, string $vorname, string $nachname) {
        $this->setUserID($user_ID);
        $this->setAnrede($anrede);
        $this->setBgColor($bg_color);
        $this->setAdresse($adresse);
        $this->setPasswort($passwort);
        $this->setGeburtsdatum($geburtsdatum);
        $this->setVorname($vorname);
        $this->setNachname($nachname);
    }

    // Getter und Setter
    public function getUserID(): int {
        return $this->user_ID;
    }

    public function getAnrede(): string {
        return $this->anrede;
    }

    public function setAnrede(string $anrede): void {
        $this->anrede = $anrede;
    }

    public function getBgColor(): string {
        return $this->bg_color;
    }

    public function setBgColor(string $bg_color): void {
        $this->bg_color = $bg_color;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }

    public function getPasswort(): string {
        return $this->passwort;
    }

    public function setPasswort(string $passwort): void {
        $this->passwort = password_hash($passwort, PASSWORD_DEFAULT);
    }

    public function getGeburtsdatum(): string {
        return $this->geburtsdatum;
    }

    public function setGeburtsdatum(string $geburtsdatum): void {
        $this->geburtsdatum = $geburtsdatum;
    }

    public function getVorname(): string {
        return $this->vorname;
    }

    public function setVorname(string $vorname): void {
        $this->vorname = $vorname;
    }

    public function getNachname(): string {
        return $this->nachname;
    }

    public function setNachname(string $nachname): void {
        $this->nachname = $nachname;
    }
}





?>