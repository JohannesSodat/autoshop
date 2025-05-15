<?php
function getThemeClass(): string {
    if (!isset($_SESSION['bg_color']) || empty($_SESSION['bg_color'])) {
        $_SESSION['bg_color'] = 'standard'; // fallback
    }

    return 'theme-' . htmlspecialchars($_SESSION['bg_color']);
}
?>