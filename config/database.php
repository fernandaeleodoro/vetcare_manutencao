<?php

define('BASE_URL', '/fernanda_2026/vetcare_manutencao');

$host = 'localhost';
$porta = '3307';
$banco = 'vetcare';
$usuario = 'root';
$senha = '';

try {
    $pdo = new PDO(
        "mysql:host={$host};port={$porta};dbname={$banco};charset=utf8mb4",
        $usuario,
        $senha
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    error_log('Erro de conexão ao banco: ' . $e->getMessage());
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados.');
}