<?php
require_once __DIR__.'/config/database.php';

if (session_status() === PHP_SESSION_NONE) session_start();

$erro = '';

if (!empty($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = (string) ($_POST['senha'] ?? '');

    if ($usuario === '' || $senha === '') {
        $erro = 'Informe usuário e senha.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = ? LIMIT 1');
        $stmt->execute([$usuario]);
        $conta = $stmt->fetch();

        $senhaValida = false;
        if ($conta) {
            $senhaValida = password_verify($senha, $conta['senha']) || hash_equals($conta['senha'], $senha);
        }

        if (!$senhaValida) {
            $erro = 'Credenciais inválidas.';
        } else {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = (int) $conta['id'];
            $_SESSION['usuario_nome'] = $conta['nome'];

            if (password_needs_rehash($conta['senha'], PASSWORD_DEFAULT)) {
                $hash = password_hash($senha, PASSWORD_DEFAULT);
                $atualizar = $pdo->prepare('UPDATE usuarios SET senha = ? WHERE id = ?');
                $atualizar->execute([$hash, $conta['id']]);
            }

            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
    }
}

$titulo = 'Entrar';
include __DIR__.'/includes/header.php';
?>
<div class="login-box"><h1>🐾 VetCare</h1><p class="muted">Acesse o sistema da clínica.</p>
<?php if ($erro): ?><div class="alert"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<form method="post"><div class="field"><label>Usuário</label><input name="usuario" value="<?= htmlspecialchars($usuario ?? '') ?>" required></div><div class="field"><label>Senha</label><input type="password" name="senha" required></div><button type="submit" class="btn-primary"><span aria-hidden="true">✓</span> Entrar</button></form>
<p class="muted">Acesso de demonstração: admin / admin123</p></div>
<?php include __DIR__.'/includes/footer.php'; ?>
