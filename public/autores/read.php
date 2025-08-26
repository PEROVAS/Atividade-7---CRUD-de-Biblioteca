<?php
include '../conexao.php';
$filtro = $_GET['filtro'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;
$where = $filtro
  ? "WHERE nome LIKE '%$filtro%' OR nacionalidade LIKE '%$filtro%'"
  : '';
$totalRes = $conn->query("SELECT COUNT(*) AS total FROM autores $where");
$total = $totalRes->fetch_assoc()['total'];
$pages = ceil($total / $limit);
$sql = "SELECT * FROM autores $where LIMIT $offset,$limit";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<body>
<h2>Autores</h2>
<form>
  <input name="filtro" placeholder="Buscar" value="<?= htmlspecialchars($filtro) ?>">
  <button>Filtrar</button>
</form>
<a href="criar.php">Novo Autor</a>
<table border="1" cellpadding="5">
  <tr><th>ID</th><th>Nome</th><th>Nacionalidade</th><th>Ano</th><th>Ações</th></tr>
  <?php while ($a = $res->fetch_assoc()): ?>
  <tr>
    <td><?= $a['id_autor'] ?></td>
    <td><?= htmlspecialchars($a['nome']) ?></td>
    <td><?= htmlspecialchars($a['nacionalidade']) ?></td>
    <td><?= $a['ano_nascimento'] ?></td>
    <td>
      <a href="editar.php?id=<?= $a['id_autor'] ?>">Editar</a>
      <a href="excluir.php?id=<?= $a['id_autor'] ?>">Excluir</a>
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
