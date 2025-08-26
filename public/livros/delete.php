<?php
include '../conexao.php';
$id = intval($_GET['id']);
$conn->query("DELETE FROM livros WHERE id_livro=$id");
header('Location: listar.php');
exit;
?>
