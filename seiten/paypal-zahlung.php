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

// PayPal API-Währung
$currency = "EUR"; // Euro
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Zahlung</title>
    <script src="https://www.paypal.com/sdk/js?client-id=DEIN_PAYPAL_CLIENT_ID&currency=<?php echo $currency; ?>"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
        }
        .container {
            margin: 50px auto;
            width: 50%;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
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

<div class="container">
    <h2>PayPal-Zahlung</h2>
    <p>Gesamtbetrag: <strong><?php echo number_format($gesamtpreis, 2, ',', '.') . " €"; ?></strong></p>

    <!-- PayPal Button -->
    <div id="paypal-button-container"></div>

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
</div>

</body>

<footer>
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
</footer>
</html>
