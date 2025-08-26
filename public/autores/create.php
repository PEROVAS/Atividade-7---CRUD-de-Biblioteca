<?php
include '../conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = $_POST['nome'];
  $nacionalidade = $_POST['nacionalidade'];
  $ano_nascimento = $_POST['ano_nascimento'];
  $conn->query("INSERT INTO autores (nome,nacionalidade,ano_nascimento) VALUES ('$nome','$nacionalidade',$ano_nascimento)");
  header('Location: listar.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Cadastrar Autor</h2>
<form method="post">
  <input name="nome" placeholder="Nome" required><br>
  <input name="nacionalidade" placeholder="Nacionalidade" required><br>
  <input name="ano_nascimento" type="number" placeholder="Ano de nascimento" required><br>
  <button type="submit">Salvar</button>
</form>
<a href="listar.php">Voltar</a>
</body>
</html>
