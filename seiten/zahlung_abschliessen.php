<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php"); // Theme-Funktion einbinden

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
    die("Fehler beim Aktualisieren des Bestands: " . htmlspecialchars($e->getMessage()));
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
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo getThemeClass(); ?>">

    <h1>Vielen Dank für Ihre Bestellung!</h1>
    <p>Die Lieferzeit beträgt: <strong><?php echo $lieferzeit; ?> Wochen</strong></p>
    <a href="index.php" class="button">Weiter shoppen</a>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>
</body>
</html>
