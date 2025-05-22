<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

// Set default theme if not set
if (!isset($_SESSION['bg_color'])) {
    $_SESSION['bg_color'] = 'standard'; // or 'eisberg'
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo getThemeClass(); ?>">


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
    <h2>Login</h2>
    <form method="post" action="login_verarbeiten.php">
        <label for="vorname">Vorname:</label>
        <input type="text" name="vorname" required><br><br>

        <label for="nachname">Nachname:</label>
        <input type="text" name="nachname" required><br><br>

        <label for="passwort">Passwort:</label>
        <input type="password" name="passwort" required><br><br>

        <input type="submit" value="Login">
        <p>Du hast noch kein Konto? <a href="registrierung.php">Jetzt registrieren</a></p>
        <p>Du willst auf den Admin Bereich zugreifen?<a href="admin_login.php">Admin Login</a></p>

        

    </form>



    <?php
    if (isset($_SESSION['login_error'])) {
        echo "<p style='color:red;'>".$_SESSION['login_error']."</p>";
        unset($_SESSION['login_error']);
    }
    ?>
</div>

<footer>
    <a href="impressum.php">Impressum und Kontakt</a> | <a href="datenschutz.php">Datenschutzerklärung</a>
</footer>

</body>
</html>
