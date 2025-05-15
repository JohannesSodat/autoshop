<?php
session_start();
require_once("themeHelper.php");

// Set default theme if not set
if (!isset($_SESSION['bg_color'])) {
    $_SESSION['bg_color'] = 'standard';
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Impressum | AutoShop</title>
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

<div class="wrapper">
    <h1>Impressum</h1>

    <h2>Angaben gemäß § 5 TMG</h2>
    <p><strong>AutoShop GmbH</strong></p>
    <p>Zernattostraße 2<br>
    9800 Spittal an der Drau<br>
    Österreich</p>

    <p><strong>Vertreten durch:</strong><br>
    Michael Pölzl<br>
    Johannes Sodat</p>

    <h2>Kontakt</h2>
    <p>Telefon: +43 6644178816<br>
    E-Mail 1: 
    <a href="mailto:poelzl.michael@hakspittal.at">poelzl.michael@hakspittal.at</a></p>
    <p>E-Mail 2: 
    <a href="mailto:sodat.johanne@hakspittal.at">sodat.johanne@hakspittal.at</a></p>

    <h2>Registereintrag</h2>
    <p>Eintragung im Firmenbuch.<br>
    Firmenbuchgericht: Klagenfurt<br>
    Firmenbuchnummer: FN 123456a</p>

    <h2>Umsatzsteuer-ID</h2>
    <p>Umsatzsteuer-Identifikationsnummer gemäß §27a Umsatzsteuergesetz:<br>
    ATU12345678</p>

    <h2>Haftungsausschluss</h2>
    <p>Trotz sorgfältiger inhaltlicher Kontrolle übernehmen wir keine Haftung für die Inhalte externer Links. Für den Inhalt der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.</p>

    <h2>Urheberrecht</h2>
    <p>Die durch die Seitenbetreiber erstellten Inhalte und Werke auf dieser Website unterliegen dem österreichischen Urheberrecht. Beiträge Dritter sind als solche gekennzeichnet.</p>

    <hr>
    <p><em>© <?php echo date("Y"); ?> AutoShop GmbH – Alle Rechte vorbehalten.</em></p>
</div>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>

</body>
</html>
