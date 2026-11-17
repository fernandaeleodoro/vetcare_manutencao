<?php
require_once __DIR__.'/../app/config/database.php';require_once __DIR__.'/../app/config/auth.php';exigirLogin();
$id=(int)($_GET['id']??0);
try{$s=$pdo->prepare("DELETE FROM animais");
$s->execute([$id]);}catch(PDOException $e){}
header('Location: index.php');exit;
