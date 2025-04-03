<!-- login.php -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login_verarbeiten.php">
        <label for="user_id">Benutzer-ID:</label>
        <input type="number" name="user_id" required><br><br>

        <label for="passwort">Passwort:</label>
        <input type="password" name="passwort" required><br><br>

        <input type="submit" value="Login">
    </form>

    <?php
    session_start();
    if (isset($_SESSION['login_error'])) {
        echo "<p style='color:red;'>".$_SESSION['login_error']."</p>";
        unset($_SESSION['login_error']);
    }
    ?>
</body>
</html>
