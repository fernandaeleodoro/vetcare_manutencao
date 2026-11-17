<?php
require_once __DIR__.'/app/config/database.php';
if (session_status() === PHP_SESSION_NONE) session_start();
session_destroy();
header('Location: ' . BASE_URL . '/login.php'); exit;
