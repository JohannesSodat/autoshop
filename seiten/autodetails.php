<?php
session_start();
require_once("dbconnection.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["auto_id"])) {
    $auto_id = intval($_POST["auto_id"]);

    $sql = "SELECT * FROM auto WHERE aID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$auto_id]);
    $auto = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Kein Auto ausgewählt.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Auto Details</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<header>
    <div><img src="images/logo.png" alt="Autoshop Logo" class="logo"></div>
    <div class="header-links">
        <a href="login.php">Login</a>
        <a href="warenkorb.php"><img src="images/shopping-cart-icon.png" alt="Warenkorb"></a>
        <a href="karte.php"><img src="images/karten-icon.png" alt="Standort"></a>
    </div>
</header>

<main>
    <h1><?= htmlspecialchars($auto['bezeichnung'] ?? '') ?> - <?= htmlspecialchars($auto['model'] ?? '') ?></h1>
    <p><strong>Preis:</strong> <?= htmlspecialchars($auto['preis'] ?? '') ?> €</p>
    <p><strong>Marke:</strong> <?= htmlspecialchars($auto['marke'] ?? '') ?></p>
    <p><strong>Der KM-Stand liegt bei:</strong> <?= htmlspecialchars($auto['kmStand'] ?? '') ?></p>
    <p><strong>Bestand verfügbar:</strong> <?= htmlspecialchars($auto['bestand'] ?? '') ?></p>
    
    <!-- Formular für den Warenkorb -->
    <form action="warenkorb.php" method="POST">
        <input type="hidden" name="auto_id" value="<?= $auto['aID'] ?>">
        <button type="submit" class="btn-warenkorb">In den Warenkorb</button>
    </form>
    
    <br>
    <a href="index.php">Zurück zum Shop</a>
</main>


<footer>
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
</footer>

</body>
</html>
