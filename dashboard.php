<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Willkommen, <?php echo htmlspecialchars($_SESSION['vorname']); ?>!</h1>
    <p>Du bist eingeloggt als <?php echo $_SESSION['rolle'] ?? 'Benutzer'; ?>.</p>

    <a href="logout.php">Logout</a>
</body>
</html>
