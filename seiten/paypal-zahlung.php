<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

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

$currency = "EUR";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zahlung</title>
    <script src="https://www.paypal.com/sdk/js?client-id=DEIN_PAYPAL_CLIENT_ID&currency=<?php echo $currency; ?>"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo getThemeClass(); ?>">

<header>
    <div>
        <img src="images/logo.png" alt="Autoshop Logo" class="logo"> 
    </div>
    <div class="header-links">
        <a href="login.php">Login</a>
        <a href="warenkorb.php"><img src="images/shopping-cart-icon.png" alt="Warenkorb"></a> 
        <a href="karte.php"><img src="images/karten-icon.png" alt="Standort"></a> 
    </div>
</header>

<main>
    <h2>PayPal Überweisung</h2>
    <div class="betrag">Gesamtbetrag: <strong><?php echo number_format($gesamtpreis, 2, ',', '.') . " €"; ?></strong></div>

    <div id="paypal-button-container"></div>

    <form action="zahlung_abschliessen.php" method="post">
        <input type="hidden" name="betrag" value="<?php echo number_format($gesamtpreis, 2, '.', ''); ?>">
        <button type="submit" class="weiter-button">Bezahlen</button>
    </form>
</main>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo number_format($gesamtpreis, 2, '.', ''); ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Zahlung erfolgreich! Danke, ' + details.payer.name.given_name);
                window.location.href = 'zahlung-erfolgreich.php';
            });
        }
    }).render('#paypal-button-container');
</script>

</body>
</html>
