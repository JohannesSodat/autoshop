<?php
    session_start();
    require_once("dbconnection.php");


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoshop</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            text-align: center; /* Zentriert alle Texte standardmäßig */
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
        main {
            padding: 50px 20px;
        }
        h1 {
            text-align: center;
        }
        p {
            text-align: center;
            text-decoration: underline; /* Unterstrichene Unterschrift */
        }
        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
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
        <a href="login.php">Login</a>
        <a href="warenkorb.php"><img src="images/shopping-cart-icon.png" alt="Warenkorb"></a> 
        <a href="karte.php"><img src="images/karten-icon.png" alt="Standort"></a> 
    </div>
</header>

<main>
    <h1>Willkommen im Autoshop</h1>
    <p>Hier finden Sie die besten Autos zu den besten Preisen!</p>
</main>

<footer>
    <a href="impressum.php">Impressum</a> | <a href="kontakt.php">Kontakt</a>
</footer>

</body>
</html>
