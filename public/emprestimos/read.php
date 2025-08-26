<?php
include '../conexao.php';
$tipo = $_GET['tipo'] ?? 'ativos';
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;
$where = $tipo === 'concluidos'
  ? "data_devolucao IS NOT NULL"
  : "data_devolucao IS NULL";
$totalRes = $conn->query("SELECT COUNT(*) AS total FROM emprestimos WHERE $where");
$total = $totalRes->fetch_assoc()['total'];
$pages = ceil($total / $limit);
$sql = "SELECT e.*, l.titulo, r.nome
  FROM emprestimos e
  JOIN livros l ON e.id_livro=l.id_livro
  JOIN leitores r ON e.id_leitor=r.id_leitor
  WHERE $where
  LIMIT $offset,$limit";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<body>
<h2>Empréstimos (<?= $tipo ?>)</h2>
<a href="listar.php?tipo=ativos">Ativos</a> |
<a href="listar.php?tipo=concluidos">Concluídos</a> |
<a href="criar.php">Novo</a>
<table border="1" cellpadding="5">
  <tr><th>ID</th><th>Livro</th><th>Leitor</th>
      <th>Emprest.</th><th>Devolução</th><th>Ações</th></tr>
  <?php while ($e = $res->fetch_assoc()): ?>
  <tr>
    <td><?= $e['id_emprestimo'] ?></td>
    <td><?= htmlspecialchars($e['titulo']) ?></td>
    <td><?= htmlspecialchars($e['nome']) ?></td>
    <td><?= $e['data_emprestimo'] ?></td>
    <td><?= $e['data_devolucao'] ?: '-' ?></td>
    <td>
      <a href="editar.php?id=<?= $e['id_emprestimo'] ?>">Editar</a>
      <a href="excluir.php?id=<?= $e['id_emprestimo'] ?>">Excluir</a>
    </td>
  </tr>
  <?php endwhile ?>
</table>
<div>
  <?php for ($i = 1; $i <= $pages; $i++): ?>
    <a href="?tipo=<?= $tipo ?>&page=<?= $i ?>"><?= $i ?></a>
  <?php endfor ?>
</div>
</body>
</html>
