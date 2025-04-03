<?php
session_start();

// Gesamtpreis berechnen
$gesamtpreis = 0;
if (isset($_SESSION['warenkorb']) && !empty($_SESSION['warenkorb'])) {
    foreach ($_SESSION['warenkorb'] as $produkt) {
        $gesamtpreis += $produkt['preis'];
    }
}

// Falls kein Warenkorb vorhanden ist oder leer
if ($gesamtpreis == 0) {
    die("Dein Warenkorb ist leer. <a href='warenkorb.php'>Zurück zum Warenkorb</a>");
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banküberweisung Zahlung</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center; /* Zentriert alle Texte standardmäßig */
        }
        header {
            background-color: rgb(25, 115, 205);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }
        .logo {
            height: 50px;
            width: auto;
        }
        .header-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .header-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .header-links img {
            width: 30px;
            height: 30px;
        }
        main {
            padding: 50px 20px;
        }
        h1 {
            text-align: center;
        }
        p {
            text-align: center;
            text-decoration: underline; /* Unterstrichene Unterschrift */
        }
        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        footer a {
            margin: 0 10px;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

<header>
    <img src="logo.png" alt="Autoshop Logo" class="logo">
    <div class="header-links">
        <a href="index.php">Startseite</a>
        <a href="warenkorb.php">Warenkorb</a>
        <a href="kontakt.php">Kontakt</a>
    </div>
</header>

<main>
    <h1>Banküberweisung Zahlung</h1>
    <p>Gesamtbetrag: <strong><?php echo number_format($gesamtpreis, 2, ',', '.') . " €"; ?></strong></p>
    <p>Bitte überweise den Gesamtbetrag auf das folgende Bankkonto:</p>
    <p><strong>Bank: Musterbank</strong></p>
    <p><strong>IBAN: DE12345678901234567890</strong></p>
    <p><strong>BIC: MUSTDEFFXXX</strong></p>
    <p>Verwendungszweck: Deine Bestellnummer #<?php echo rand(1000, 9999); ?></p>

    <p>Nachdem die Zahlung eingegangen ist, werden wir deine Bestellung bearbeiten und versenden.</p>
    <p>Bei Fragen stehen wir dir gerne zur Verfügung.</p>

    <p><a href="index.php">Zurück zur Startseite</a></p>
</main>

<footer>
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
</footer>

</body>
</html>
