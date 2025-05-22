<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE pflegeprodukte SET pfname = ?, preis = ?, bezeichnung = ?, bestand = ?, marke = ?, benutzung = ?, ablaufdatum = ? WHERE pfID = ?");
    $stmt->execute([
        $_POST['pfname'], $_POST['preis'], $_POST['bezeichnung'], $_POST['bestand'],
        $_POST['marke'], $_POST['benutzung'], $_POST['ablaufdatum'], $_POST['pfID']
    ]);
    header("Location: admin_view.php");
    exit();
} else {
    $stmt = $pdo->prepare("SELECT * FROM pflegeprodukte WHERE pfID = ?");
    $stmt->execute([$_GET['id']]);
    $produkt = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="de">
<head><meta charset="UTF-8"><title>Pflegeprodukt bearbeiten</title></head>
<body>
<h2>Pflegeprodukt bearbeiten</h2>
<form method="post">
    <input type="hidden" name="pfID" value="<?= $produkt['pfID'] ?>">
    Name: <input type="text" name="pfname" value="<?= $produkt['pfname'] ?>"><br>
    Preis: <input type="number" step="0.01" name="preis" value="<?= $produkt['preis'] ?>"><br>
    Bezeichnung: <input type="text" name="bezeichnung" value="<?= $produkt['bezeichnung'] ?>"><br>
    Bestand: <input type="number" name="bestand" value="<?= $produkt['bestand'] ?>"><br>
    Marke: <input type="text" name="marke" value="<?= $produkt['marke'] ?>"><br>
    Benutzung: <input type="text" name="benutzung" value="<?= $produkt['benutzung'] ?>"><br>
    Ablaufdatum: <input type="date" name="ablaufdatum" value="<?= $produkt['ablaufdatum'] ?>"><br>
    <input type="submit" value="Speichern">
</form>
</body>
</html>