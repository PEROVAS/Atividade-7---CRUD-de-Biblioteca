<?php
include '../conexao.php';
$id = intval($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $conn->query("UPDATE leitores SET nome='$nome',email='$email',telefone='$telefone' WHERE id_leitor=$id");
  header('Location: listar.php');
  exit;
}
$r = $conn->query("SELECT * FROM leitores WHERE id_leitor=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<body>
<h2>Editar Leitor</h2>
<form method="post">
  <input name="nome" value="<?= htmlspecialchars($r['nome']) ?>" required><br>
  <input name="email" type="email" value="<?= htmlspecialchars($r['email']) ?>" required><br>
  <input name="telefone" value="<?= htmlspecialchars($r['telefone']) ?>" required><br>
  <button type="submit">Atualizar</button>
</form>
<a href="listar.php">Voltar</a>
</body>
</html>
