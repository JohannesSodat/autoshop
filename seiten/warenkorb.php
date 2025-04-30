<?php
session_start();
require_once("dbconnection.php");

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warenkorb</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
        }
        header {
            background-color: rgb(25, 115, 205);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }
        .cart-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            text-align: left;
        }
        .cart-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .pay-buttons {
            margin-top: 20px;
        }
        .pay-buttons button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
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
        img {
            width: 30px;
            height: 30px;
        }
        .paypal {
            background-color: #ffc439;
        }
        .bank {
            background-color: #4CAF50;
            color: white;
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
    <h1>Dein Warenkorb</h1>

    <div class="header-links">
        <a href="index.php">Startseite</a>
        <a href="login.php">Login</a>
        <a href="karte.php"><img src="images/karten-icon.png" alt="Standort"></a> 
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
    </div>
</div>

<footer>
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
</footer>

</body>
</html>
