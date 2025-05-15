<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

// Theme aus DB holen
$bg_color = 'standard'; // Default-Wert

if (isset($_SESSION['user_id'])) {
    $stmt_theme = $pdo->prepare("SELECT bg_color FROM user WHERE id = :id");
    $stmt_theme->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt_theme->execute();
    $user = $stmt_theme->fetch(PDO::FETCH_ASSOC);

    $bg_color = htmlspecialchars($_SESSION['bg_color']); // XSS-Schutz
}

// Aktuelle Seite und Kategorie
$limit = 20;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;
$quelle = isset($_GET['quelle']) && $_GET['quelle'] === 'pflegeprodukte' ? 'pflegeprodukte' : 'auto';

// SQL je nach Quelle
if ($quelle === 'pflegeprodukte') {
    $stmt = $pdo->prepare("SELECT pfID AS id, pfname AS name, preis, bezeichnung FROM pflegeprodukte LIMIT :limit OFFSET :offset");
} else {
    $stmt = $pdo->prepare("SELECT aID AS id, bezeichnung AS name, preis, model AS zusatzinfo FROM auto LIMIT :limit OFFSET :offset");
}

$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Autoshop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="<?php echo getThemeClass(); ?>">

<header>
    <div><img src="images/logo.png" alt="Autoshop Logo" class="logo"></div>
    <div class="header-links">
        <a href="login.php">Login</a>
        <a href="warenkorb.php"><img src="images/shopping-cart-icon.png" alt="Warenkorb" width="30"></a>
        <a href="karte.php"><img src="images/karten-icon.png" alt="Standort" width="30"></a>
    </div>
</header>

<main>
    <h1>Willkommen im Shop</h1>

    <form method="get" class="filter">
        <label for="kategorie">Kategorie wählen:</label>
        <select name="quelle" id="kategorie" onchange="this.form.submit()">
            <option value="auto" <?= $quelle === 'auto' ? 'selected' : '' ?>>Autos</option>
            <option value="pflegeprodukte" <?= $quelle === 'pflegeprodukte' ? 'selected' : '' ?>>Pflegeprodukte</option>
        </select>
    </form>

    <br>

    <div class="car-container">
        <?php foreach ($result as $produkt): ?>
            <div class="car-card">
                <h3><?= htmlspecialchars($produkt['name']) ?></h3>

                <?php if ($quelle === 'auto'): ?>
                    <p><strong>Modell:</strong> <?= htmlspecialchars($produkt['zusatzinfo']) ?></p>
                <?php else: ?>
                    <p><strong>Beschreibung:</strong> <?= htmlspecialchars($produkt['bezeichnung']) ?></p>
                <?php endif; ?>

                <p><strong>Preis:</strong> €<?= number_format($produkt['preis'], 2, ',', '.') ?></p>

                <?php if ($quelle === 'auto'): ?>
                    <form action="autodetails.php" method="post">
                        <input type="hidden" name="auto_id" value="<?= $produkt['id'] ?>">
                        <input type="hidden" name="quelle" value="auto">
                        <button type="submit">Mehr Infos hier</button>
                    </form>
                <?php else: ?>
                    <form action="warenkorb.php" method="post">
                        <input type="hidden" name="produkt_id" value="<?= $produkt['id'] ?>">
                        <input type="hidden" name="produkt_name" value="<?= $produkt['name'] ?>">
                        <input type="hidden" name="preis" value="<?= $produkt['preis'] ?>">
                        <button type="submit">In den Warenkorb</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?quelle=<?= $quelle ?>&page=<?= $page - 1 ?>">&laquo; Zurück</a>
        <?php endif; ?>
        <a href="?quelle=<?= $quelle ?>&page=<?= $page + 1 ?>">Weiter &raquo;</a>
    </div>
</main>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>

</body>
</html>
