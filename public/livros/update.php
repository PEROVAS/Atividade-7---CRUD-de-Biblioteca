<?php
include '../conexao.php';
$id = intval($_GET['id']);
$currentYear = date('Y');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $genero = $_POST['genero'];
  $ano = intval($_POST['ano_publicacao']);
  $autor = intval($_POST['id_autor']);
  if ($ano <= 1500 || $ano > $currentYear) {
    die("Ano inválido");
  }
  $conn->query("UPDATE livros SET titulo='$titulo',genero='$genero',ano_publicacao=$ano,id_autor=$autor WHERE id_livro=$id");
  header('Location: listar.php');
  exit;
}
$r = $conn->query("SELECT * FROM livros WHERE id_livro=$id")->fetch_assoc();
$aut = $conn->query("SELECT id_autor,nome FROM autores");
?>
<!DOCTYPE html>
<html>
<body>
<h2>Editar Livro</h2>
<form method="post">
  <input name="titulo" value="<?= htmlspecialchars($r['titulo']) ?>" required><br>
  <input name="genero" value="<?= htmlspecialchars($r['genero']) ?>" required><br>
  <input name="ano_publicacao" type="number" value="<?= $r['ano_publicacao'] ?>" required><br>
  <select name="id_autor" required>
    <?php while ($a = $aut->fetch_assoc()): ?>
      <option value="<?= $a['id_autor'] ?>" <?= $a['id_autor']==$r['id_autor']?'selected':'' ?>>
        <?= htmlspecialchars($a['nome']) ?>
      </option>
    <?php endwhile ?>
  </select><br>
  <button type="submit">Atualizar</button>
</form>
<a href="listar.php">Voltar</a>
</body>
</html>
