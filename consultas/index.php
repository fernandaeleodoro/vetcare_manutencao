<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
exigirLogin();

$titulo = 'Consultas';
$status = $_GET['status'] ?? '';
$sql = "SELECT c.*, a.nome AS animal FROM consultas c JOIN animais a ON a.id=c.animal_id";
$params = [];
if ($status !== '') {
    $sql .= " WHERE c.status=?";
    $params[] = $status;
}
$sql .= " ORDER BY c.data_consulta DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();
include __DIR__ . '/../includes/header.php';
?>
<h1>Consultas</h1>
<p class="muted">Agenda e histórico de atendimentos.</p>
<div class="actions"><a class="btn btn-primary" href="form.php"><span aria-hidden="true">＋</span> Nova consulta</a></div>
<section class="panel">
<form method="get">
<div class="field"><label>Filtrar por status</label>
<select name="status"><option value="">Todos</option><?php foreach (['Agendada','Realizada','Cancelada'] as $op): ?><option value="<?= htmlspecialchars($op) ?>" <?= $status === $op ? 'selected' : '' ?>><?= htmlspecialchars($op) ?></option><?php endforeach; ?></select>
</div>
<button type="submit"><span aria-hidden="true">🔍</span> Filtrar</button>
<?php if ($status !== ''): ?> <a class="btn secondary" href="index.php"><span aria-hidden="true">×</span> Limpar</a><?php endif; ?>
</form>
</section>
<div class="panel table-wrap">
<table>
<tr><th>Animal</th><th>Data</th><th>Veterinário</th><th>Motivo</th><th>Status</th><th>Ações</th></tr>
<?php foreach ($rows as $r): ?>
<tr>
<td><?= htmlspecialchars($r['animal']) ?></td>
<td><?= date('d/m/Y H:i', strtotime($r['data_consulta'])) ?></td>
<td><?= htmlspecialchars($r['veterinario']) ?></td>
<td><?= htmlspecialchars($r['motivo']) ?></td>
<td><?= htmlspecialchars($r['status']) ?></td>
<td class="acoes-tabela">
<a class="btn btn-primary btn-table" href="form.php?id=<?= (int) $r['id'] ?>"><span aria-hidden="true">✎</span> Editar</a>
<a class="btn btn-danger btn-table" href="excluir.php?id=<?= (int) $r['id'] ?>" onclick="return confirm('Deseja realmente excluir esta consulta?');"><span aria-hidden="true">🗑</span> Excluir</a>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
