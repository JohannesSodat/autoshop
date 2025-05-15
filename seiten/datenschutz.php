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
    <title>Datenschutzerklärung | AutoShop</title>
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
    <h1>Datenschutzerklärung</h1>

    <p>Der Schutz Ihrer persönlichen Daten ist uns ein besonderes Anliegen. Wir verarbeiten Ihre Daten daher ausschließlich auf Grundlage der gesetzlichen Bestimmungen (DSGVO, TKG 2003).</p>

    <h2>1. Allgemeines</h2>
    <p>Diese Datenschutzerklärung klärt Sie über die Art, den Umfang und Zweck der Verarbeitung personenbezogener Daten innerhalb unseres Onlineangebotes auf.</p>

    <h2>2. Verantwortlicher</h2>
    <p><strong>AutoShop GmbH</strong><br>
    Zernattostraße 2<br>
    9800 Spittal an der Drau<br>
    Österreich<br>
    E-Mail 1: <a href="mailto:poelzl.michael@hakspittal.at">poelzl.michael@hakspittal.at</a></p>
    <p>E-Mail 2: <a href="mailto:sodat.johannes@hakspittal.at">sodat.johannes@hakspittal.at</a></p>

    <h2>3. Erhebung und Verarbeitung personenbezogener Daten</h2>
    <p>Wir erheben personenbezogene Daten, wenn Sie uns diese im Rahmen einer Kontaktaufnahme (z. B. per Kontaktformular oder E-Mail) mitteilen.</p>

    <h2>4. Verwendung der Daten</h2>
    <p>Die von Ihnen bereitgestellten Daten werden nur zur Bearbeitung Ihrer Anfrage und für den Fall von Anschlussfragen sechs Monate bei uns gespeichert. Eine Weitergabe an Dritte erfolgt nicht.</p>

    <h2>5. Ihre Rechte</h2>
    <p>Ihnen stehen grundsätzlich die Rechte auf Auskunft, Berichtigung, Löschung, Einschränkung, Datenübertragbarkeit, Widerruf und Widerspruch zu. Wenn Sie glauben, dass die Verarbeitung Ihrer Daten gegen das Datenschutzrecht verstößt, können Sie sich bei der Aufsichtsbehörde beschweren.</p>

    <h2>6. Server-Logfiles</h2>
    <p>Der Provider dieser Website erhebt und speichert automatisch Informationen in sogenannten Server-Logfiles, die Ihr Browser automatisch übermittelt. Dies sind: IP-Adresse, Browsertyp, Datum und Uhrzeit, Referrer-URL. Diese Daten sind nicht bestimmten Personen zuordenbar.</p>

    <h2>7. Kontaktformular</h2>
    <p>Wenn Sie uns per Kontaktformular Anfragen zukommen lassen, werden Ihre Angaben zwecks Bearbeitung der Anfrage und für den Fall von Anschlussfragen gespeichert.</p>

    <h2>8. SSL-Verschlüsselung</h2>
    <p>Diese Seite nutzt aus Sicherheitsgründen eine SSL-Verschlüsselung. Eine verschlüsselte Verbindung erkennen Sie an „https://“ in der Adresszeile Ihres Browsers.</p>

    <hr>
    <p><em>Stand: April <?php echo date("Y"); ?></em></p>
</div>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>

</body>
</html>
