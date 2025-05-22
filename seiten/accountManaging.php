<?php
session_start();
require_once("dbconnection.php");
require_once("themeHelper.php");

// Nur eingeloggte Benutzer dürfen die Seite nutzen
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success = $error = "";

// Benutzer aktualisieren
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $anrede = $_POST["anrede"] ?? '';
    $bg_color = $_POST["bg_color"] ?? '';
    $passwort_neu = $_POST["passwort"] ?? '';

    if (!empty($anrede) && !empty($bg_color)) {
        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("UPDATE user SET anrede = :anrede, bg_color = :bg_color WHERE user_ID = :id");
            $stmt->execute([
                ':anrede' => $anrede,
                ':bg_color' => $bg_color,
                ':id' => $user_id
            ]);

            if (!empty($passwort_neu)) {
                $hash = password_hash($passwort_neu, PASSWORD_DEFAULT);
                $stmt_pw = $pdo->prepare("UPDATE user SET passwort = :pw WHERE user_ID = :id");
                $stmt_pw->execute([
                    ':pw' => $hash,
                    ':id' => $user_id
                ]);
            }

            $_SESSION['bg_color'] = $bg_color;

            $pdo->commit();
            $success = "Daten erfolgreich aktualisiert.";
        } catch (PDOException $e) {
            $pdo->rollBack();
            $error = "Fehler beim Aktualisieren: " . $e->getMessage();
        }
    } else {
        $error = "Bitte fülle alle Pflichtfelder aus.";
    }
}

// Aktuelle Nutzerdaten holen
$stmt = $pdo->prepare("SELECT anrede, bg_color FROM user WHERE user_ID = :id");
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Account verwalten</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .button-container {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .button-container .button,
        .button-container button {
            flex: 1;
            min-width: 150px;
            max-width: 200px;
            padding: 10px 0;
            text-align: center;
            background-color: #007BFF;
            color: white;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container form {
            margin: 0;
        }

        .container select,
        .container input[type="password"] {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="<?php echo getThemeClass(); ?>">

<header>
    <h1>Account verwalten</h1>
</header>

<main class="container">
    <?php if ($success): ?><p style="color:green;"><?= $success ?></p><?php endif; ?>
    <?php if ($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>

    <form method="post" id="accountForm">
        <label>Anrede:</label>
        <select name="anrede">
            <option value="Herr" <?= $user['anrede'] === 'Herr' ? 'selected' : '' ?>>Herr</option>
            <option value="Frau" <?= $user['anrede'] === 'Frau' ? 'selected' : '' ?>>Frau</option>
            <option value="Divers" <?= $user['anrede'] === 'Divers' ? 'selected' : '' ?>>Divers</option>
        </select>

        <label>Theme auswählen:</label>
        <select name="bg_color">
            <option value="standard" <?= $user['bg_color'] === 'standard' ? 'selected' : '' ?>>Standard</option>
            <option value="dark" <?= $user['bg_color'] === 'dark' ? 'selected' : '' ?>>Dark</option>
            <option value="eisberg" <?= $user['bg_color'] === 'eisberg' ? 'selected' : '' ?>>Eisberg</option>
            <option value="sonnig" <?= $user['bg_color'] === 'sonnig' ? 'selected' : '' ?>>Sonnig</option>
        </select>

        <label>Neues Passwort (optional):</label>
        <input type="password" name="passwort" placeholder="Leer lassen, um es nicht zu ändern">
    </form>

    <div class="button-container">
        <button type="submit" form="accountForm" class="button">Daten speichern</button>

        <form action="logout.php" method="post">
            <button type="submit" class="button">Abmelden</button>
        </form>

        <a href="index.php" class="button">Zurück zur Startseite</a>
    </div>
</main>

<footer>
    <a href="impressum.php">Impressum</a> | <a href="datenschutz.php">Datenschutz</a>
</footer>

</body>
</html>
