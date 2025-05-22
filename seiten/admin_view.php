<?php
session_start();
require_once("themeHelper.php");
require_once("dbconnection.php");

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Admin Bereich</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?php echo getThemeClass(); ?>">

<header>
    <h1>Admin Bereich</h1>
</header>

<div class="container">
    <p>Willkommen im Adminbereich!</p>
    <p><a href="admin_logout.php">Logout</a></p>

    <h2>Pflegeprodukte</h2>
    <table class="admin-table">

        <tr>
            <th>ID</th><th>Name</th><th>Preis</th><th>Bestand</th><th>Aktionen</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT pfID, pfname, preis, bestand FROM pflegeprodukte");
        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['pfID']}</td>
                    <td>{$row['pfname']}</td>
                    <td>{$row['preis']}</td>
                    <td>{$row['bestand']}</td>
                    <td>
                        <a href='edit_pflegeprodukt.php?id={$row['pfID']}'>Bearbeiten</a> |
                        <a href='delete_pflegeprodukt.php?id={$row['pfID']}'>Löschen</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>

    <h2>Autos</h2>
    <table class="admin-table">
        <tr>
            <th>ID</th><th>Modell</th><th>Kennzeichen</th><th>Preis</th><th>Aktionen</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT aID, model, kennzeichen, preis FROM auto");
        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['aID']}</td>
                    <td>{$row['model']}</td>
                    <td>{$row['kennzeichen']}</td>
                    <td>{$row['preis']}</td>
                    <td>
                        <a href='edit_auto.php?id={$row['aID']}'>Bearbeiten</a> |
                        <a href='delete_auto.php?id={$row['aID']}'>Löschen</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>

    <h2>Benutzer</h2>
    <table class="admin-table">

        <tr>
            <th>ID</th><th>Name</th><th>Adresse</th><th>Aktionen</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT user_ID, vorname, nachname, adresse FROM user");
        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['user_ID']}</td>
                    <td>{$row['vorname']} {$row['nachname']}</td>
                    <td>{$row['adresse']}</td>
                    <td>
                        <a href='edit_user.php?id={$row['user_ID']}'>Bearbeiten</a> |
                        <a href='delete_user.php?id={$row['user_ID']}'>Löschen</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>

</div>

</body>
</html>
