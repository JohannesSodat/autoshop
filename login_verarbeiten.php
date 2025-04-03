<?php
session_start();
require_once("db.php"); // deine Datenbankverbindung
require_once("user.class.php");

$user_id = $_POST['user_id'];
$passwort = $_POST['passwort'];

$sql = "SELECT * FROM user WHERE user_ID = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user_data && password_verify($passwort, $user_data['passwort'])) {
    $_SESSION['user_id'] = $user_data['user_ID'];
    $_SESSION['rolle'] = $user_data['rolle']; // wenn du so ein Feld hast
    $_SESSION['vorname'] = $user_data['vorname'];

    header("Location: dashboard.php");
    exit;
} else {
    $_SESSION['login_error'] = "Falsche Benutzer-ID oder Passwort!";
    header("Location: login.php");
    exit;
}
?>
