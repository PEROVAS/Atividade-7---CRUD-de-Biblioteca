<?php
include '../conexao.php';
$id = intval($_GET['id']);
$conn->query("DELETE FROM leitores WHERE id_leitor=$id");
header('Location: listar.php');
exit;
?>
