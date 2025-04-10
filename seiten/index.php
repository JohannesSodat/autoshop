<?php
session_start();
require_once("dbconnection.php");

// Anzahl der Autos pro Seite
$limit = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Autos aus der Datenbank holen
$stmt = $pdo->prepare("SELECT aID, bezeichnung, model, preis FROM auto LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoshop</title>
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
        text-decoration: underline;
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

    .car-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .car-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        width: 250px;
    }

    .car-card button {
        padding: 8px 12px;
        background-color: #1973cd;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .pagination {
        margin-top: 40px;
    }

    .pagination a {
        margin: 0 10px;
        text-decoration: none;
        color: #1973cd;
        font-weight: bold;
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
    <h1>Willkommen im Autoshop</h1>
    <p>Hier finden Sie die besten Autos zu den besten Preisen!</p>

    <!-- Autos anzeigen -->
    <div class="car-container">
    <?php foreach($result as $row): ?>
        <div class="car-card">
            <h3><?= htmlspecialchars($row['bezeichnung']) ?></h3>
            <p><strong>Modell:</strong> <?= htmlspecialchars($row['model']) ?></p>
            <p><strong>Preis:</strong> €<?= number_format($row['preis'], 2, ',', '.') ?></p>
            <form action="autodetails.php" method="post">
                <input type="hidden" name="auto_id" value="<?= $row['aID'] ?>">
                <button type="submit">Mehr Infos hier</button>
            </form>
        </div>
    <?php endforeach; ?>
    </div>

    <!-- Blätterfunktion -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">&laquo; Zurück</a>
        <?php endif; ?>
        <a href="?page=<?= $page + 1 ?>">Weiter &raquo;</a>
    </div>
</main>

<footer>
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
</footer>

</body>
</html>
