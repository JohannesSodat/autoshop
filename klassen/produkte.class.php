<?php

    class Produkt {

        private $productID;
        private $pname;
        private $preis; 
        private $bezeichnung; 
        private $bestand; 
        private $marke;

        public function __construct(int $productID, string $pname, float $preis, string $bezeichnung, int $bestand, string $marke) {
            $this->setProductID($productID);
            $this->setPname($pname);
            $this->setPreis($preis);
            $this->setBezeichnung($bezeichnung);
            $this->setBestand($bestand);
            $this->setMarke($marke);
        }

        public function getProductID(): int {
            return $this->productID;
        }

        public function getPname(): string {
            return $this->pname;
        }

        public function setPname(string $pname): void {
            $this->pname = $pname;
        }

        public function getPreis(): float {
            return $this->preis;
        }

        public function setPreis(float $preis): void {
            $this->preis = $preis;
        }

        public function getBezeichnung(): string {
            return $this->bezeichnung;
        }

        public function setBezeichnung(string $bezeichnung): void {
            $this->bezeichnung = $bezeichnung;
        }

        public function getBestand(): int {
            return $this->bestand;
        }

        public function setBestand(int $bestand): void {
            $this->bestand = $bestand;
        }

        public function getMarke(): string {
            return $this->marke;
        }

        public function setMarke(string $marke): void {
            $this->marke = $marke;
        }
    }

?>