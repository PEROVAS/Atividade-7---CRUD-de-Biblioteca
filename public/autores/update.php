<?php
include '../conexao.php';
$id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $nacionalidade = $_POST['nacionalidade'];
  $ano_nascimento = $_POST['ano_nascimento'];
  $conn->query("UPDATE autores SET nome='$nome',nacionalidade='$nacionalidade',ano_nascimento=$ano_nascimento WHERE id_autor=$id");
  header('Location: listar.php');
  exit;
}
$r = $conn->query("SELECT * FROM autores WHERE id_autor=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<body>
<h2>Editar Autor</h2>
<form method="post">
  <input name="nome" value="<?= htmlspecialchars($r['nome']) ?>" required><br>
  <input name="nacionalidade" value="<?= htmlspecialchars($r['nacionalidade']) ?>" required><br>
  <input name="ano_nascimento" type="number" value="<?= $r['ano_nascimento'] ?>" required><br>
  <button type="submit">Atualizar</button>
</form>
<a href="listar.php">Voltar</a>
</body>
</html>
