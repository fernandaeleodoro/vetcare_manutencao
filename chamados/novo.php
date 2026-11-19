<?php
require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/auth.php';exigirLogin();
$titulo='Abrir chamado';$erro='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $campos=['titulo','modulo','solicitante','equipe','descricao','passos','resultado_esperado','resultado_obtido','severidade','prioridade'];
 foreach($campos as $c){$$c=trim($_POST[$c]??'');}
 if($titulo===''||$solicitante===''||$descricao===''||$passos===''||$resultado_esperado===''||$resultado_obtido==='')$erro='Preencha todos os campos obrigatórios.';
 else{
  $s=$pdo->prepare("INSERT INTO chamados(titulo,modulo,solicitante,equipe,descricao,passos,resultado_esperado,resultado_obtido,severidade,prioridade) VALUES(?,?,?,?,?,?,?,?,?,?)");
  $s->execute([$titulo,$modulo,$solicitante,$equipe,$descricao,$passos,$resultado_esperado,$resultado_obtido,$severidade,$prioridade]);
  $id=(int)$pdo->lastInsertId();
  $h=$pdo->prepare("INSERT INTO historico_chamados(chamado_id,autor,comentario,status_novo) VALUES(?,?,?,?)");
  $h->execute([$id,$solicitante,'Chamado registrado na central de suporte.','Aberto']);
  header('Location: ver.php?id='.$id.'&novo=1');exit;
 }
}
include __DIR__.'/../includes/header.php';
?>
<h1>Abrir chamado técnico</h1>
<p class="muted">Descreva o problema de forma que outra pessoa consiga reproduzi-lo.</p>
<?php if($erro):?><div class="alert"><?=htmlspecialchars($erro)?></div><?php endif;?>
<form method="post">
<section class="panel"><h2>1. Identificação</h2>
<div class="field"><label>Título objetivo *</label><input name="titulo" maxlength="160" value="<?=htmlspecialchars($_POST['titulo']??'')?>" required></div>
<div class="grid"><div class="field"><label>Módulo *</label><select name="modulo" required><?php foreach(['Login','Dashboard','Tutores','Animais','Consultas','Outro'] as $v):?><option <?=($_POST['modulo']??'')===$v?'selected':''?>><?=$v?></option><?php endforeach;?></select></div>
<div class="field"><label>Nome do solicitante/equipe *</label><input name="solicitante" value="<?=htmlspecialchars($_POST['solicitante']??'')?>" required></div>
<div class="field"><label>Turma/equipe</label><input name="equipe" value="<?=htmlspecialchars($_POST['equipe']??'')?>"></div></div></section>
<section class="panel"><h2>2. Descrição e reprodução</h2><div class="field"><label>Descrição do problema *</label><textarea name="descricao" required><?=htmlspecialchars($_POST['descricao']??'')?></textarea></div><div class="field"><label>Passos para reproduzir *</label><textarea name="passos" required><?=htmlspecialchars($_POST['passos']??'')?></textarea></div><div class="field"><label>Resultado esperado *</label><textarea name="resultado_esperado" required><?=htmlspecialchars($_POST['resultado_esperado']??'')?></textarea></div><div class="field"><label>Resultado obtido *</label><textarea name="resultado_obtido" required><?=htmlspecialchars($_POST['resultado_obtido']??'')?></textarea></div></section>
<section class="panel"><h2>3. Classificação</h2><div class="grid"><div class="field"><label>Severidade</label><select name="severidade"><?php foreach(['Baixa','Média','Alta','Crítica'] as $v):?><option <?=($_POST['severidade']??'Média')===$v?'selected':''?>><?=$v?></option><?php endforeach;?></select></div><div class="field"><label>Prioridade</label><select name="prioridade"><?php foreach(['Baixa','Média','Alta','Urgente'] as $v):?><option <?=($_POST['prioridade']??'Média')===$v?'selected':''?>><?=$v?></option><?php endforeach;?></select></div></div></section>
<div class="actions"><button type="submit" class="btn-primary"><span aria-hidden="true">✓</span> Registrar chamado</button><a class="btn secondary" href="index.php"><span aria-hidden="true">←</span> Cancelar</a></div>
</form>
<?php include __DIR__.'/../includes/footer.php';?>
