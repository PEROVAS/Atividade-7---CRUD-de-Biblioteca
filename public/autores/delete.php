<?php
include '../conexao.php';
$id = intval($_GET['id']);
$conn->query("DELETE FROM autores WHERE id_autor=$id");
header('Location: listar.php');
exit;
?>
