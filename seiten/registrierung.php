<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

// Default fallback theme if not set
if (!isset($_SESSION['bg_color'])) {
    $_SESSION['bg_color'] = 'standard';
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
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

<div class="container">
    <h2>Registrierung</h2>
    <form method="post" action="registrierung.php">
        <label for="vorname">Vorname:</label>
        <input type="text" name="vorname" required>

        <label for="nachname">Nachname:</label>
        <input type="text" name="nachname" required>

        <label for="anrede">Anrede:</label>
        <input type="text" name="anrede" required>

        <label for="bg-color">Menü-Stil:</label>
        <select name="bg-color" required>
            <option value="standard">Standard</option>
            <option value="dark">Dark-Mode</option>
            <option value="eisberg">Eisberg</option>
            <option value="sonnig">Sonnig</option>
        </select>

        <label for="adresse">Adresse:</label>
        <input type="text" name="adresse" required>

        <label for="geburtsdatum">Geburtsdatum:</label>
        <input type="date" name="geburtsdatum" required>

        <label for="passwort">Passwort:</label>
        <input type="password" name="passwort" required>

        <input type="submit" value="Registrieren">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vorname = trim($_POST['vorname']);
        $nachname = trim($_POST['nachname']);
        $anrede = trim($_POST['anrede']);
        $bg_color = trim($_POST['bg-color']);
        $adresse = trim($_POST['adresse']);
        $geburtsdatum = $_POST['geburtsdatum'];
        $passwort = $_POST['passwort'];

        // Passwort hashen
        $passwort_gehasht = password_hash($passwort, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO user (vorname, nachname, anrede, bg_color, adresse, geburtsdatum, passwort) 
                    VALUES (:vorname, :nachname, :anrede, :bg_color, :adresse, :geburtsdatum, :passwort)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':vorname' => $vorname,
                ':nachname' => $nachname,
                ':anrede' => $anrede,
                ':bg_color' => $bg_color,
                ':adresse' => $adresse,
                ':geburtsdatum' => $geburtsdatum,
                ':passwort' => $passwort_gehasht
            ]);

            echo "<p style='color:green;'>Registrierung erfolgreich! Du kannst dich jetzt <a href='login.php'>einloggen</a>.</p>";

            // Session Theme setzen, damit es sofort greift
            $_SESSION['bg_color'] = $bg_color;

        } catch (PDOException $e) {
            echo "<p style='color:red;'>Fehler bei der Registrierung: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
    ?>
</div>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>

</body>
</html>
