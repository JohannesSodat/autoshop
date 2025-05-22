<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE user SET anrede = ?, bg_color = ?, adresse = ?, geburtsdatum = ?, vorname = ?, nachname = ? WHERE user_ID = ?");
    $stmt->execute([
        $_POST['anrede'], $_POST['bg_color'], $_POST['adresse'], $_POST['geburtsdatum'],
        $_POST['vorname'], $_POST['nachname'], $_POST['user_ID']
    ]);
    header("Location: admin_view.php");
    exit();
} else {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_ID = ?");
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="de">
<head><meta charset="UTF-8"><title>Benutzer bearbeiten</title></head>
<body>
<h2>Benutzer bearbeiten</h2>
<form method="post">
    <input type="hidden" name="user_ID" value="<?= $user['user_ID'] ?>">
    Anrede: <input type="text" name="anrede" value="<?= $user['anrede'] ?>"><br>
    Theme (bg_color): <input type="text" name="bg_color" value="<?= $user['bg_color'] ?>"><br>
    Adresse: <input type="text" name="adresse" value="<?= $user['adresse'] ?>"><br>
    Geburtsdatum: <input type="date" name="geburtsdatum" value="<?= $user['geburtsdatum'] ?>"><br>
    Vorname: <input type="text" name="vorname" value="<?= $user['vorname'] ?>"><br>
    Nachname: <input type="text" name="nachname" value="<?= $user['nachname'] ?>"><br>
    <input type="submit" value="Speichern">
</form>
</body>
</html>
