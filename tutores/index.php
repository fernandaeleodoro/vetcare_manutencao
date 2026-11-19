<?php
require_once __DIR__.'/../config/database.php'; require_once __DIR__.'/../config/auth.php'; exigirLogin();
$titulo='Tutores';
$busca=trim($_GET['busca']??'');
$sql="SELECT * FROM tutores";
$params=[];
if($busca!==''){$sql .= " WHERE nome LIKE ?";$params[]='%'.$busca.'%';}
$sql .= " ORDER BY nome";
$stmt=$pdo->prepare($sql);$stmt->execute($params);$rows=$stmt->fetchAll();
include __DIR__.'/../includes/header.php';
?>
<h1>Tutores</h1><p class="muted">Cadastro e consulta de responsáveis pelos animais.</p>
<div class="actions"><a class="btn btn-primary" href="form.php"><span aria-hidden="true">＋</span> Novo tutor</a></div>
<section class="panel"><form method="get"><div class="field"><label>Buscar tutor</label><input name="busca" value="<?=htmlspecialchars($busca)?>" placeholder="Digite o nome"></div><button type="submit"><span aria-hidden="true">🔍</span> Buscar</button><?php if($busca!==''): ?> <a class="btn secondary" href="index.php"><span aria-hidden="true">×</span> Limpar</a><?php endif; ?></form></section>
<div class="panel table-wrap"><table><tr><th>Nome</th><th>Telefone</th><th>E-mail</th><th>Estado</th><th>Ações</th></tr>
<?php foreach($rows as $r): ?><tr><td><?=htmlspecialchars($r['nome'])?></td><td><?=htmlspecialchars($r['telefone'])?></td><td><?=htmlspecialchars($r['email'])?></td><td><?=$r['ativo']?'Ativo':'Inativo'?></td><td class="acoes-tabela"><a class="btn btn-primary btn-table" href="form.php?id=<?=$r['id']?>"><span aria-hidden="true">✎</span> Editar</a> <a class="btn btn-danger btn-table" href="excluir.php?id=<?=$r['id']?>" onclick="return confirm('Deseja realmente excluir este tutor?');"><span aria-hidden="true">🗑</span> Excluir</a></td></tr><?php endforeach;?>
</table></div>
<?php include __DIR__.'/../includes/footer.php'; ?>