<?php
session_start();

// Nur die Admin-bezogenen Session-Variablen löschen
unset($_SESSION['is_admin']);
unset($_SESSION['admin_vorname']); // falls du später Admin-Namen speicherst

// Optional: gesamte Session zerstören, wenn keine anderen Daten (z. B. Warenkorb) gebraucht werden
// session_destroy();

// Weiterleitung zur Login-Seite
header("Location: admin_login.php");
exit();
?>
