<?php

define('BASE_URL', '/vetcare_manutencao');

$host = 'localhost';
$porta = '3307';
$banco = 'vetcare';
$usuario = 'root';
$senha = '';

try {
    $conn = new PDO(
        "mysql:host=$host;port=$porta;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn;

} catch (PDOException $e) {
    die("Erro ao conectar ao banco: " . $e->getMessage());
}