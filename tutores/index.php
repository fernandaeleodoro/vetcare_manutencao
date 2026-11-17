<?php
require_once __DIR__.'/../app/config/database.php'; require_once __DIR__.'/../app/config/auth.php'; exigirLogin();
$titulo='Tutores';
$busca=trim($_GET['busca']??'');
$sql="SELECT * FROM tutores";
$params=[];
if($busca!==''){
    $sql .= " WHERE nome LIKE ?";
    $params[]='%'.$busca.'%';
}
$sql .= " ORDER BY nome";
$stmt=$pdo->prepare($sql); $stmt->execute($params); $rows=$stmt->fetchAll();
include __DIR__.'/../app/includes/header.php';
?>
<h1>Tutores</h1><p class="muted">Cadastro e consulta de responsáveis pelos animais.</p>
<div class="actions" ><a class="btn" href="form.php">+ Novo tutor</a></div>
<section class="panel"><form method="get"><div class="field"><label>Buscar tutor</label><input name="busca" value="<?=htmlspecialchars($busca)?>" placeholder="Digite o nome"></div><button>Buscar</button></form></section>
<div class="panel table-wrap"><table><tr><th>Nome</th><th>Telefone</th><th>E-mail</th><th>Estado</th><th>Ações</th></tr>
<?php foreach($rows as $r): ?><tr><td><?=htmlspecialchars($r['nome'])?></td><td><?=htmlspecialchars($r['telefone'])?></td><td><?=htmlspecialchars($r['email'])?></td><td><?=$r['ativo']?'Ativo':'Inativo'?></td><td><a href="form.php?id=<?=$r['id']?>">Editar</a> | <a href="excluir.php?id=<?=$r['id']?>" onclick="return confirm('Deseja realmente excluir este tutor?');">Excluir</a></td></tr><?php endforeach;?>
</table></div>
<?php include __DIR__.'/../app/includes/footer.php'; ?>