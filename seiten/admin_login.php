<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

if (!isset($_SESSION['bg_color'])) {
    $_SESSION['bg_color'] = 'standard';
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo getThemeClass(); ?>">

<header>
    <div>
        <img src="images/logo.png" alt="Autoshop Logo" class="logo">
    </div>
</header>

<div class="container">
    <h2>Admin Login</h2>
    <form method="post" action="admin_login_verarbeiten.php">
        <label for="adminPW">Admin-Passwort:</label>
        <input type="password" name="adminPW" required><br><br>
        <input type="submit" value="Login als Admin">
    </form>

    <?php
    if (isset($_SESSION['admin_error'])) {
        echo "<p style='color:red;'>".$_SESSION['admin_error']."</p>";
        unset($_SESSION['admin_error']);
    }
    ?>
</div>

<footer>
    <a href="index.php">Zurück zur Startseite</a>
</footer>

</body>
</html>
