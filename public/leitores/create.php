<?php
include '../conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $conn->query("INSERT INTO leitores (nome,email,telefone) VALUES ('$nome','$email','$telefone')");
  header('Location: listar.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Cadastrar Leitor</h2>
<form method="post">
  <input name="nome" placeholder="Nome" required><br>
  <input name="email" type="email" placeholder="Email" required><br>
  <input name="telefone" placeholder="Telefone" required><br>
  <button type="submit">Salvar</button>
</form>
<a href="listar.php">Voltar</a>
</body>
</html>
