<?php

class Standort {

    // Attribute
    private int $s_ID;
    private int $plz;
    private int $mitarbeiterzahl;
    private string $typ;
    private string $adresse;

    // Konstruktor mit Parametern
    public function __construct(int $s_ID, int $plz, int $mitarbeiterzahl, string $typ, string $adresse) {
        $this->s_ID = $s_ID;
        $this->plz = $plz;
        $this->mitarbeiterzahl = $mitarbeiterzahl;
        $this->typ = $typ;
        $this->adresse = $adresse;
    }

    // Methoden
    public function neuerStandort(int $s_ID, int $plz, int $mitarbeiterzahl, string $typ, string $adresse): void {
        $this->s_ID = $s_ID;
        $this->plz = $plz;
        $this->mitarbeiterzahl = $mitarbeiterzahl;
        $this->typ = $typ;
        $this->adresse = $adresse;
    }

    public function schließenStandort(): void {
        $this->s_ID = 0;
        $this->plz = 0;
        $this->mitarbeiterzahl = 0;
        $this->typ = "geschlossen";
        $this->adresse = "";
    }

    public function changeStandort(int $plz, int $mitarbeiterzahl, string $typ, string $adresse): void {
        $this->plz = $plz;
        $this->mitarbeiterzahl = $mitarbeiterzahl;
        $this->typ = $typ;
        $this->adresse = $adresse;
    }

    // Getter
    public function getAdresse(): string {
        return $this->adresse;
    }

    public function getPlz(): int {
        return $this->plz;
    }

    public function getMitarbeiter(): int {
        return $this->mitarbeiterzahl;
    }
}

?>
