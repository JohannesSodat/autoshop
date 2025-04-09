<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $nachricht = htmlspecialchars($_POST["nachricht"]);

  

    echo "<h2>Vielen Dank, $name! Deine Nachricht wurde gesendet.</h2>";
    echo "<p><a href='impressum_kontakt.php'>Zurück zur Kontaktseite</a></p>";
} else {
    header("Location: impressum_kontakt.php");
    exit;
}
?>
