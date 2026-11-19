<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$titulo = $titulo ?? 'VetCare';
$baseUrl = defined('BASE_URL') ? BASE_URL : '/fernanda_2026/vetcare_manutencao';
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($titulo) ?> | VetCare</title>
<link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/assets/style.css">
</head>
<body>
<header class="topbar">
  <a class="brand" href="<?= htmlspecialchars($baseUrl) ?>/index.php">🐾 VetCare</a>
  <nav>
    <?php if (!empty($_SESSION['usuario_id'])): ?>
      <a href="<?= htmlspecialchars($baseUrl) ?>/index.php">Painel</a>
      <a href="<?= htmlspecialchars($baseUrl) ?>/tutores/index.php">Tutores</a>
      <a href="<?= htmlspecialchars($baseUrl) ?>/animais/index.php">Animais</a>
      <a href="<?= htmlspecialchars($baseUrl) ?>/consultas/index.php">Consultas</a>
      <a href="<?= htmlspecialchars($baseUrl) ?>/chamados/index.php">Suporte</a>
      <button type="button" class="btn-sair" id="abrirConfirmacaoSair" aria-haspopup="dialog"><span aria-hidden="true">↪</span> Sair</button>
    <?php endif; ?>
  </nav>
</header>
<main class="container">
