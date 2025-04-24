<?php
    session_start();
    require_once("dbconnection.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
        }
        header {
            background-color: rgb(25, 115, 205);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }
        .logo {
            height: 50px;
            width: auto;
        }
        .header-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .header-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .header-links img {
            width: 30px;
            height: 30px;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            flex: 1;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: rgb(25, 115, 205);
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: rgb(20, 90, 180);
        }
        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
        }
        footer a {
            margin: 0 10px;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

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
    </form>

    <?php
    if (isset($_SESSION['login_error'])) {
        echo "<p style='color:red;'>".$_SESSION['login_error']."</p>";
        unset($_SESSION['login_error']);
    }
    ?>
</div>

<footer>
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
</footer>

</body>
</html>
