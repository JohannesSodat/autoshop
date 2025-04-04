<?php
session_start();
require_once("dbconnection.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
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
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        input[type="text"], input[type="password"], input[type="submit"], select, input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: rgb(25, 115, 205);
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: rgb(20, 90, 180);
        }
        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            width: 100%;
            margin-top: auto;
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
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $anrede = $_POST['anrede'];
        $bg_color = $_POST['bg-color'];
        $adresse = $_POST['adresse'];
        $geburtsdatum = $_POST['geburtsdatum'];
        $passwort = $_POST['passwort'];

        // Passwort hashen
        $passwort_gehasht = password_hash($passwort, PASSWORD_DEFAULT);

        try {
            // DB-Verbindung über dbconnection.php (muss $pdo enthalten)
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
        } catch (PDOException $e) {
            echo "<p style='color:red;'>Fehler bei der Registrierung: " . $e->getMessage() . "</p>";
        }
    }
    ?>
</div>

<footer>
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
</footer>

</body>
</html>
