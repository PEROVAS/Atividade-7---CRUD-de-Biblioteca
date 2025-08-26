<?php
include '../conexao.php';
$currentYear = date('Y');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $genero = $_POST['genero'];
  $ano = intval($_POST['ano_publicacao']);
  $autor = intval($_POST['id_autor']);
  if ($ano <= 1500 || $ano > $currentYear) {
    die("Ano inválido");
  }
  $conn->query("INSERT INTO livros (titulo,genero,ano_publicacao,id_autor) VALUES ('$titulo','$genero',$ano,$autor)");
  header('Location: listar.php');
  exit;
}
$aut = $conn->query("SELECT id_autor,nome FROM autores");
?>
<!DOCTYPE html>
<html>
<body>
<h2>Cadastrar Livro</h2>
<form method="post">
  <input name="titulo" placeholder="Título" required><br>
  <input name="genero" placeholder="Gênero" required><br>
  <input name="ano_publicacao" type="number" placeholder="Ano de publicação" required><br>
  <select name="id_autor" required>
    <option value="">Autor</option>
    <?php while ($a = $aut->fetch_assoc()): ?>
      <option value="<?= $a['id_autor'] ?>"><?= htmlspecialchars($a['nome']) ?></option>
    <?php endwhile ?>
  </select><br>
  <button type="submit">Salvar</button>
</form>
<a href="listar.php">Voltar</a>
</body>
</html>
