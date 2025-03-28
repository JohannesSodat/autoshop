<?php   
   
   class Event {
            private $event_ID;
            private $eintrittspreis;
            private $eventName;
            private $datum;

            public function __construct(int $event_ID, float $eintrittspreis, string $eventName, DateTime $datum) {
                $this->event_ID = $event_ID;
                $this->eintrittspreis = $eintrittspreis;
                $this->eventName = $eventName;
                $this->datum = $datum;
            }

            public function neuesEvent(): void {
                // SQL-Query zum Einfügen eines neuen Events in die Datenbank
                $sql = "INSERT INTO events (event_ID, eventName, eintrittspreis, datum) 
                        VALUES (:event_ID, :eventName, :eintrittspreis, :datum)";
                
                // Vorbereitung und Bindung der Parameter
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':event_ID', $this->event_ID);
                $stmt->bindParam(':eventName', $this->eventName);
                $stmt->bindParam(':eintrittspreis', $this->eintrittspreis);
                $stmt->bindParam(':datum', $this->datum->format('Y-m-d H:i:s')); // Datum im richtigen Format
        
                // Ausführen des Statements
                if ($stmt->execute()) {
                    echo "Neues Event: $this->eventName wurde erstellt.";
                } else {
                    echo "Fehler beim Erstellen des Events.";
                }
            }

            public function loeschenEvent(): void {
                // SQL-Query zum Löschen eines Events aus der Datenbank
                $sql = "DELETE FROM events WHERE event_ID = :event_ID";
                
                // Vorbereitung und Bindung der Parameter
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':event_ID', $this->event_ID);

                // Ausführen des Statements
                if ($stmt->execute()) {
                    echo "Event: $this->eventName wurde gelöscht.";
                } else {
                    echo "Fehler beim Löschen des Events.";
                }
            }

            public function changeEvent(): void {
                // SQL-Query zum Aktualisieren eines Events
                $sql = "UPDATE events SET eventName = :eventName, eintrittspreis = :eintrittspreis, datum = :datum
                WHERE event_ID = :event_ID";

                // Vorbereitung und Bindung der Parameter
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':event_ID', $this->event_ID);
                $stmt->bindParam(':eventName', $this->eventName);
                $stmt->bindParam(':eintrittspreis', $this->eintrittspreis);
                $stmt->bindParam(':datum', $this->datum->format('Y-m-d H:i:s')); // Datum im richtigen Format

                // Ausführen des Statements
                if ($stmt->execute()) {
                    echo "Event: $this->eventName wurde geändert.";
                } else {
                    echo "Fehler beim Ändern des Events.";
                }
}

            }

            public function getEventName(): string {
                return $this->eventName;
            }

            public function getEintrittspreis(): float {
                return $this->eintrittspreis;
            }

            public function getDatum(): DateTime {
                return $this->datum;
            }
        

    ?>