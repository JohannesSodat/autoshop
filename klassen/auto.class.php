    <?php

    class Auto extends Produkt {
        private $a_ID;
        private $plakette;
        private $kennzeichen;
        private $kmStand;
        private $model;

        public function __construct(int $productID, int $a_ID, string $pname, float $preis, string $bezeichnung, int $bestand, string $marke, DateTime $plakette, string $kennzeichen, int $kmStand, string $model) {
            parent::__construct($productID, $pname, $preis, $bezeichnung, $bestand, $marke);
            $this->a_ID = $a_ID;
            $this->setPlakette($plakette);
            $this->setKennzeichen($kennzeichen);
            $this->setKmStand($kmStand);
            $this->setModel($model);
        }

        public function getA_ID(): int {
              return $this->a_ID;
        }
        


        public function getPlakette(): DateTime {
            return $this->Plakette;
        }

        public function setPlakette(DateTime $plakette): void {
            $this->plakette = $plakette;
        }

        public function getKennzeichen(): string {
            return $this->kennzeichen;
        }

        public function setKennzeichen(string $kennzeichen): void {
            $this->kennzeichen = $kennzeichen;
        }

        public function getKmStand(): int {
            return $this->kmStand;
        }

        public function setKmStand(int $kmStand): void {
            $this->kmStand = $kmStand;
        }

        public function getModel(): string {
            return $this->model;
        }

        public function setModel(string $model): void {
            $this->model = $model;
        }
    }

    ?>