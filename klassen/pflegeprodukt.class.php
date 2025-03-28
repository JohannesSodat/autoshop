<?php

    class Pflegeprodukt extends Produkt {
        private $pf_ID;
        private $benutzung;
        private $ablaufdatum;

        public function __construct(int $productID, int $pf_ID, string $pname, float $preis, string $bezeichnung, int $bestand, string $marke, string $benutzung, DateTime $ablaufdatum) {
            parent::__construct($productID, $pname, $preis, $bezeichnung, $bestand, $marke);
            $this->pf_ID = $pf_ID;
            $this->setBenutzung($benutzung);
            $this->setAblaufdatum($ablaufdatum);
        }

        public function getPf_ID(): int {
            return $this->pf_ID;
        }
        
        public function getBenutzung(): string {
            return $this->benutzung;
        }

        public function setBenutzung(string $benutzung): void {
            $this->benutzung = $benutzung;
        }

        public function getAblaufdatum(): DateTime {
            return $this->ablaufdatum;
        }

        public function setAblaufdatum(DateTime $ablaufdatum): void {
            $this->ablaufdatum = $ablaufdatum;
        }
    }


?>