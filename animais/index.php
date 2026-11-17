<?php
require_once __DIR__.'/../app/config/database.php';require_once __DIR__.'/../app/config/auth.php';exigirLogin();
$titulo='Animais';
$rows=$pdo->query("SELECT a.*,t.nome AS tutor FROM animais a JOIN tutores t ON t.id=a.tutor_id ORDER BY a.nome")->fetchAll();
include __DIR__.'/../app/includes/header.php';?>
<h1>Animais</h1><p class="muted">Pacientes cadastrados na clínica.</p><div class="actions"><a class="btn" href="form.php">+ Novo animal</a></div>
<div class="panel table-wrap"><table><tr><th>Nome</th><th>Espécie</th><th>Raça</th><th>Tutor</th><th>Nascimento</th><th>Idade</th><th>Ações</th></tr>
<?php foreach($rows as $r):
    $idade = 0;
    if (!empty($r['nascimento'])) {
        $hoje = new DateTime('today');
        $nascimento = new DateTime($r['nascimento']);
        $idade = $hoje->diff($nascimento)->y;
    }
?>
<tr><td><?=htmlspecialchars($r['nome'])?></td><td><?=htmlspecialchars($r['especie'])?></td><td><?=htmlspecialchars($r['raca'])?></td><td><?=htmlspecialchars($r['tutor'])?></td><td><?=$r['nascimento']?date('d/m/Y',strtotime($r['nascimento'])):'-'?></td><td><?=$idade?> ano(s)</td><td><a href="form.php?id=<?=$r['id']?>">Editar</a> | <a href="excluir.php?id=<?=$r['id']?>" onclick="return confirm('Deseja realmente excluir este animal?');">Excluir</a></td></tr><?php endforeach;?>
</table></div><?php include __DIR__.'/../app/includes/footer.php';?>
