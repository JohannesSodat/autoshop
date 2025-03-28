<?php 

    class Admin extends User {
        private $ad_ID; 
        private $adminPW;

        public function __construct(int $user_ID, string $anrede, string $bg_color, string $adresse, string $passwort, string $geburtsdatum, string $vorname, string $nachname, int $ad_ID, string $adminPW) {
            parent::__construct($user_ID, $anrede, $bg_color, $adresse, $passwort, $geburtsdatum, $vorname, $nachname);
            $this->setAdminID($ad_ID;)
            $this->setAdminPW($adminPW);
        }

        public function getAdminID() : int {
            return $this->ad_ID;
        }


        public function getAdminPW(): string {
            return $this->adminPW;
        }

        public function setAdminPW(string $adminPW): void {
            $this->adminPW = password_hash($adminPW, PASSWORD_DEFAULT);
        }

        

    }



?>