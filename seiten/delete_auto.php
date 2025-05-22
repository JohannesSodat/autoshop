<?php

session_start();
require_once("dbconnection.php");

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$stmt = $pdo->prepare("DELETE FROM auto WHERE aID = ?");
$stmt->execute([$_GET['id']]);

header("Location: admin_view.php");
exit();

?>
