<?php
include '../conexao.php';
$filtro = $_GET['filtro'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;
$where = $filtro
  ? "WHERE nome LIKE '%$filtro%' OR email LIKE '%$filtro%'"
  : '';
$totalRes = $conn->query("SELECT COUNT(*) AS total FROM leitores $where");
$total = $totalRes->fetch_assoc()['total'];
$pages = ceil($total / $limit);
$sql = "SELECT * FROM leitores $where LIMIT $offset,$limit";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<body>
<h2>Leitores</h2>
<form>
  <input name="filtro" placeholder="Buscar" value="<?= htmlspecialchars($filtro) ?>">
  <button>Filtrar</button>
</form>
<a href="criar.php">Novo Leitor</a>
<table border="1" cellpadding="5">
  <tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>
  <?php while ($l = $res->fetch_assoc()): ?>
  <tr>
    <td><?= $l['id_leitor'] ?></td>
    <td><?= htmlspecialchars($l['nome']) ?></td>
    <td><?= htmlspecialchars($l['email']) ?></td>
    <td><?= htmlspecialchars($l['telefone']) ?></td>
    <td>
      <a href="editar.php?id=<?= $l['id_leitor'] ?>">Editar</a>
      <a href="excluir.php?id=<?= $l['id_leitor'] ?>">Excluir</a>
    </td>
  </tr>
  <?php endwhile ?>
</table>
<div>
  <?php for ($i = 1; $i <= $pages; $i++): ?>
    <a href="?filtro=<?= urlencode($filtro) ?>&page=<?= $i ?>"><?= $i ?></a>
  <?php endfor ?>
</div>
</body>
</html>
