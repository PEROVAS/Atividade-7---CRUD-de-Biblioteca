<?php
include '../conexao.php';
$id = intval($_GET['id']);
$conn->query("DELETE FROM emprestimos WHERE id_emprestimo=$id");
header('Location: listar.php');
exit;
?>
