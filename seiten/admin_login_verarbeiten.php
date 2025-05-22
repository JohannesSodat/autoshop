<?php
session_start();
require_once("dbconnection.php"); // Verbindung zur Datenbank

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $adminPW = $_POST['adminPW'];

    try {
        $sql = "SELECT * FROM admin WHERE adminPW = :adminPW";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':adminPW' => $adminPW]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            // Admin-Zugriff erlauben
            $_SESSION['is_admin'] = true;
            $_SESSION['admin_name'] = $admin['vorname'] . ' ' . $admin['nachname']; // optional
            header("Location: admin_view.php");
            exit();
        } else {
            $_SESSION['admin_error'] = "Falsches Admin-Passwort.";
            header("Location: admin_login.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Fehler bei der Datenbankverbindung: " . $e->getMessage();
    }
}
?>
