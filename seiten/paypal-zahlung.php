<?php
session_start();
require_once("dbconnection.php");

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
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            text-align: center;
            min-height: 100vh;
            background-color: #f9f9f9;
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
            flex: 1;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .betrag {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        #paypal-button-container {
            max-width: 400px;
            margin: 0 auto 20px;
        }

        .weiter-button {
            background-color: #1973cd;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .weiter-button:hover {
            background-color: #125a9c;
        }

        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            margin-top: auto;
        }

        footer a {
            margin: 0 10px;
            text-decoration: none;
            color: black;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

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
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
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
