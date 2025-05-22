<?php
session_start();
require_once("dbconnection.php"); // Verbindung zur Datenbank

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $passwort = $_POST['passwort'];

    try {
        $sql = "SELECT * FROM user WHERE vorname = :vorname AND nachname = :nachname";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':vorname' => $vorname,
            ':nachname' => $nachname
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($passwort, $user['passwort'])) {
            // Benutzerdaten in der Session speichern
            $_SESSION['user_id'] = $user['user_ID'];
            $_SESSION['vorname'] = $user['vorname'];
            $_SESSION['nachname'] = $user['nachname'];
            $_SESSION['bg_color'] = $user['bg_color'] ?? 'standard'; // fallback auf 'standard' falls leer

            // Weiterleitung auf Startseite oder Dashboard
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Login fehlgeschlagen. Bitte überprüfe deine Eingaben.";
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Fehler bei der Datenbankverbindung: " . $e->getMessage();
    }
}
?>
