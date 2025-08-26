<?php
include '../conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $l = intval($_POST['id_livro']);
  $r = intval($_POST['id_leitor']);
  $d1 = $_POST['data_emprestimo'];
  $d2 = $_POST['data_devolucao'] ?: null;
  $v1 = $conn->query("SELECT * FROM emprestimos WHERE id_livro=$l AND data_devolucao IS NULL");
  if ($v1->num_rows) die("Livro indisponível");
  $v2 = $conn->query("SELECT * FROM emprestimos WHERE id_leitor=$r AND data_devolucao IS NULL");
  if ($v2->num_rows >= 3) die("Limite de empréstimos atingido");
  if ($d2 && $d2 < $d1) die("Data de devolução inválida");
  $v2 = $d2
    ? "('$d2')"
    : "(NULL)";
  $conn->query("INSERT INTO emprestimos (id_livro,id_leitor,data_emprestimo,data_devolucao)
    VALUES ($l,$r,'$d1',$v2)");
  header('Location: listar.php');
  exit;
}
$lv = $conn->query("SELECT id_livro,titulo FROM livros");
$le = $conn->query("SELECT id_leitor,nome FROM leitores");
?>
<!DOCTYPE html>
<html>
<body>
<h2>Registrar Empréstimo</h2>
<form method="post">
  <select name="id_livro" required>
    <option value="">Livro</option>
    <?php while ($a = $lv->fetch_assoc()): ?>
      <option value="<?= $a['id_livro'] ?>"><?= htmlspecialchars($a['titulo']) ?></option>
    <?php endwhile ?>
  </select><br>
  <select name="id_leitor" required>
    <option value="">Leitor</option>
    <?php while ($b = $le->fetch_assoc()): ?>
      <option value="<?= $b['id_leitor'] ?>"><?= htmlspecialchars($b['nome']) ?></option>
    <?php endwhile ?>
  </select><br>
  <input name="data_emprestimo" type="date" required><br>
  <input name="data_devolucao" type="date"><br>
  <button type="submit">Salvar</button>
</form>
<a href="listar.php">Voltar</a>
</body>
</html>
