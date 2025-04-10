<?php
session_start();
require_once("dbconnection.php");

// Prüfen, ob ein Warenkorb existiert
if (!isset($_SESSION['warenkorb']) || empty($_SESSION['warenkorb'])) {
    die("Dein Warenkorb ist leer. <a href='index.php'>Zurück zur Startseite</a>");
}

// Bestand in der Datenbank reduzieren
try {
    $pdo->beginTransaction();

    foreach ($_SESSION['warenkorb'] as $artikel) {
        $stmt = $pdo->prepare("UPDATE auto SET bestand = bestand - 1 WHERE aID = :id AND bestand > 0");
        $stmt->execute([':id' => $artikel['id']]);
    }

    $pdo->commit();

} catch (PDOException $e) {
    $pdo->rollBack();
    die("Fehler beim Aktualisieren des Bestands: " . $e->getMessage());
}

// Zufällige Lieferzeit in Wochen
$lieferzeit = rand(2, 10);

// Warenkorb leeren
unset($_SESSION['warenkorb']);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellung abgeschlossen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            margin: 0;
        }
        h1 {
            color: green;
        }
        p {
            font-size: 18px;
            margin: 20px 0;
        }
        a.button {
            display: inline-block;
            padding: 12px 25px;
            background-color: rgb(25, 115, 205);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        a.button:hover {
            background-color: rgb(20, 90, 180);
        }
    </style>
</head>
<body>

    <h1>Vielen Dank für Ihre Bestellung!</h1>
    <p>Die Lieferzeit beträgt: <strong><?php echo $lieferzeit; ?> Wochen</strong></p>
    <a href="index.php" class="button">Weiter shoppen</a>

</body>
</html>
