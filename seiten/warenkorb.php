<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php"); // Theme-Funktion einbinden

// Prüfen, ob der Warenkorb existiert, andernfalls initialisieren
if (!isset($_SESSION['warenkorb'])) {
    $_SESSION['warenkorb'] = [];
}

// Falls ein Produkt hinzugefügt wird
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // AUTO hinzufügen
    if (isset($_POST["auto_id"])) {
        $auto_id = intval($_POST["auto_id"]);
        $sql = "SELECT aID AS id, bezeichnung AS name, preis FROM auto WHERE aID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$auto_id]);
        $produkt = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // PFLEGEPRODUKT hinzufügen
    elseif (isset($_POST["produkt_id"])) {
        $produkt_id = intval($_POST["produkt_id"]);
        $sql = "SELECT pfID AS id, pfname AS name, preis FROM pflegeprodukte WHERE pfID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$produkt_id]);
        $produkt = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Wenn ein Produkt gefunden wurde, hinzufügen
    if (!empty($produkt)) {
        $exists = false;
        foreach ($_SESSION['warenkorb'] as $item) {
            if ($item['id'] === $produkt['id']) {
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $_SESSION['warenkorb'][] = $produkt;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Warenkorb</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body class="<?php echo getThemeClass(); ?>">

<header>
    <h1>Dein Warenkorb</h1>

    <div class="header-links">
        <a href="index.php">Startseite</a>
        <?php if (isset($_SESSION['vorname'])): ?>
            <a href="accountManaging.php">Account</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
        <a href="karte.php"><img src="images/karten-icon.png" alt="Standort" /></a>
    </div>
</header>

<div class="cart-container">
    <h2>Produkte im Warenkorb:</h2>

    <?php
    if (empty($_SESSION['warenkorb'])) {
        echo "<p>Dein Warenkorb ist leer.</p>";
    } else {
        $gesamtpreis = 0;
        foreach ($_SESSION['warenkorb'] as $produkt) {
            echo "<div class='cart-item'>";
            echo "<strong>" . htmlspecialchars($produkt['name']) . "</strong> - " . number_format($produkt['preis'], 2, ',', '.') . " €";
            echo "</div>";
            $gesamtpreis += $produkt['preis'];
        }
        echo "<h3>Gesamt: " . number_format($gesamtpreis, 2, ',', '.') . " €</h3>";
    }
    ?>

    <div class="pay-buttons">
        <button class="paypal" onclick="window.location.href='paypal-zahlung.php'">Mit PayPal zahlen</button>
        <button class="bank" onclick="window.location.href='bankueberweisung.php'">Per Banküberweisung zahlen</button>
        <button class="shoppen" onclick="window.location.href='index.php'">Weitershoppen</button>
    </div>
</div>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>

</body>
</html>
