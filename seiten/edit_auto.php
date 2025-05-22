<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE auto SET plakette = ?, kennzeichen = ?, kmStand = ?, model = ?, pname = ?, preis = ?, bezeichnung = ?, bestand = ?, marke = ? WHERE aID = ?");
    $stmt->execute([
        $_POST['plakette'], $_POST['kennzeichen'], $_POST['kmStand'], $_POST['model'],
        $_POST['pname'], $_POST['preis'], $_POST['bezeichnung'], $_POST['bestand'], $_POST['marke'], $_POST['aID']
    ]);
    header("Location: admin_view.php");
    exit();
} else {
    $stmt = $pdo->prepare("SELECT * FROM auto WHERE aID = ?");
    $stmt->execute([$_GET['id']]);
    $auto = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="de">
<head><meta charset="UTF-8"><title>Auto bearbeiten</title></head>
<body>
<h2>Auto bearbeiten</h2>
<form method="post">
    <input type="hidden" name="aID" value="<?= $auto['aID'] ?>">
    Plakette: <input type="text" name="plakette" value="<?= $auto['plakette'] ?>"><br>
    Kennzeichen: <input type="text" name="kennzeichen" value="<?= $auto['kennzeichen'] ?>"><br>
    kmStand: <input type="number" name="kmStand" value="<?= $auto['kmStand'] ?>"><br>
    Modell: <input type="text" name="model" value="<?= $auto['model'] ?>"><br>
    Produktname: <input type="text" name="pname" value="<?= $auto['pname'] ?>"><br>
    Preis: <input type="number" step="0.01" name="preis" value="<?= $auto['preis'] ?>"><br>
    Bezeichnung: <input type="text" name="bezeichnung" value="<?= $auto['bezeichnung'] ?>"><br>
    Bestand: <input type="number" name="bestand" value="<?= $auto['bestand'] ?>"><br>
    Marke: <input type="text" name="marke" value="<?= $auto['marke'] ?>"><br>
    <input type="submit" value="Speichern">
</form>
</body>
</html>