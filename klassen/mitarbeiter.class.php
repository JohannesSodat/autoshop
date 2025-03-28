<?php

    class Mitarbeiter extends User {
        private $m_ID;
        private $gehalt;
        private $stelle;

        public function __construct(int $user_ID, string $anrede, string $bg_color, string $adresse, string $passwort, string $geburtsdatum, string $vorname, string $nachname, int $m_ID, float $gehalt, string $stelle) {
            parent::__construct($user_ID, $anrede, $bg_color, $adresse, $passwort, $geburtsdatum, $vorname, $nachname);
            $this->setMitarbeiterID($m_ID);
            $this->setGehalt($gehalt);
            $this->setStelle($stelle);
        }

        public function getMitarbeiterID(): int {
            return $this->m_ID;
        }

        public function getGehalt(): float {
            return $this->gehalt;
        }

        public function setGehalt(float $gehalt): void {
            $this->gehalt = $gehalt;
        }

        public function getStelle(): string {
            return $this->stelle;
        }

        public function setStelle(string $stelle): void {
            $this->stelle = $stelle;
        }
    }


?>