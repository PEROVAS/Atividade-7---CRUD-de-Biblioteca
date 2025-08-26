<?php
include '../conexao.php';
$filtro = $_GET['filtro'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;
$where = $filtro
  ? "WHERE livros.genero LIKE '%$filtro%' OR autores.nome LIKE '%$filtro%' OR livros.ano_publicacao LIKE '%$filtro%'"
  : '';
$totalRes = $conn->query("SELECT COUNT(*) AS total FROM livros JOIN autores ON livros.id_autor=autores.id_autor $where");
$total = $totalRes->fetch_assoc()['total'];
$pages = ceil($total / $limit);
$sql = "SELECT livros.*,autores.nome AS autor FROM livros JOIN autores ON livros.id_autor=autores.id_autor $where LIMIT $offset,$limit";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<body>
<h2>Livros</h2>
<form>
  <input name="filtro" placeholder="Buscar" value="<?= htmlspecialchars($filtro) ?>">
  <button>Filtrar</button>
</form>
<a href="criar.php">Novo Livro</a>
<table border="1" cellpadding="5">
  <tr><th>ID</th><th>Título</th><th>Gênero</th><th>Ano</th><th>Autor</th><th>Ações</th></tr>
  <?php while ($l = $res->fetch_assoc()): ?>
  <tr>
    <td><?= $l['id_livro'] ?></td>
    <td><?= htmlspecialchars($l['titulo']) ?></td>
    <td><?= htmlspecialchars($l['genero']) ?></td>
    <td><?= $l['ano_publicacao'] ?></td>
    <td><?= htmlspecialchars($l['autor']) ?></td>
    <td>
      <a href="editar.php?id=<?= $l['id_livro'] ?>">Editar</a>
      <a href="excluir.php?id=<?= $l['id_livro'] ?>">Excluir</a>
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
