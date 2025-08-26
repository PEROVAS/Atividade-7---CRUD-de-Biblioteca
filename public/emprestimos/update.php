<?php
include '../conexao.php';
$id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $d1 = $_POST['data_emprestimo'];
  $d2 = $_POST['data_devolucao'] ?: null;
  if ($d2 && $d2 < $d1) die("Data inválida");
  $v2 = $d2
    ? "'$d2'"
    : "NULL";
  $conn->query("UPDATE emprestimos SET data_emprestimo='$d1',data_devolucao=$v2 WHERE id_emprestimo=$id");
  header('Location: listar.php');
  exit;
}
$r = $conn->query("SELECT * FROM emprestimos WHERE id_emprestimo=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<body>
<h2>Editar Empréstimo</h2>
<form method="post">
  <input name="data_emprestimo" type="date" value="<?= $r['data_emprestimo'] ?>" required><br>
  <input name="data_devolucao" type="date" value="<?= $r['data_devolucao'] ?>"><br>
  <button type="submit">Atualizar</button>
</form>
<a href="listar.php">Voltar</a>
</body>
</html>
