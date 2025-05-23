<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

// Set default theme if not set
if (!isset($_SESSION['bg_color'])) {
    $_SESSION['bg_color'] = 'standard';
}

// Gesamtpreis berechnen
$gesamtpreis = 0;
if (isset($_SESSION['warenkorb']) && !empty($_SESSION['warenkorb'])) {
    foreach ($_SESSION['warenkorb'] as $produkt) {
        $gesamtpreis += $produkt['preis'];
    }
}

if ($gesamtpreis == 0) {
    die("Dein Warenkorb ist leer. <a href='warenkorb.php'>Zurück zum Warenkorb</a>");
}

// Benutzerinfos vorbereiten
$vorname = "";
$nachname = "";
$adresse = "";

// Prüfen, ob Benutzer eingeloggt ist
if (isset($_SESSION['user_id'])) {
    try {
        $stmt = $pdo->prepare("SELECT vorname, nachname, adresse FROM user WHERE id = :id");
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $vorname = $user['vorname'];
            $nachname = $user['nachname'];
            $adresse = $user['adresse'];
        }
    } catch (PDOException $e) {
        echo "Fehler beim Abrufen der Benutzerdaten: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banküberweisung Zahlung</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo getThemeClass(); ?>">

<header>
    <div>
        <img src="images/logo.png" alt="Autoshop Logo" class="logo"> 
    </div>
    <div class="header-links">
        <a href="index.php">Startseite</a>
        <a href="warenkorb.php"><img src="images/shopping-cart-icon.png" alt="Warenkorb"></a> 
        <a href="karte.php"><img src="images/karten-icon.png" alt="Standort"></a> 
    </div>
</header>

<main>
    <h1>Banküberweisung Zahlung</h1>
    <p>Gesamtbetrag: <strong><?php echo number_format($gesamtpreis, 2, ',', '.') . " €"; ?></strong></p>

    <form method="post" action="zahlung_abschliessen.php">
        <label for="vorname">Vorname:</label><br>
        <input type="text" name="vorname" value="<?php echo htmlspecialchars($vorname); ?>" required><br>

        <label for="nachname">Nachname:</label><br>
        <input type="text" name="nachname" value="<?php echo htmlspecialchars($nachname); ?>" required><br>

        <label for="adresse">Adresse:</label><br>
        <input type="text" name="adresse" value="<?php echo htmlspecialchars($adresse); ?>" required><br><br>

        <p>Bitte überweise den Gesamtbetrag auf das folgende Bankkonto:</p>
        <p><strong>Bank: Musterbank</strong></p>
        <p><strong>IBAN: DE12345678901234567890</strong></p>
        <p><strong>BIC: MUSTDEFFXXX</strong></p>
        <p>Verwendungszweck: Deine Bestellnummer #<?php echo rand(1000, 9999); ?></p>

        <p>Nachdem die Zahlung eingegangen ist, werden wir deine Bestellung bearbeiten und versenden.</p>

        <input type="submit" value="Bestellung abschließen">
    </form>

    <p><a href="index.php">Zurück zur Startseite</a></p>
</main>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>

</body>
</html>
