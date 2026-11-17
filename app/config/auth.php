<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function exigirLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ' . BASE_URL . '/login.php');
        exit;
    }
}
