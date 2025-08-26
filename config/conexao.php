<?php
$host = "localhost";
$user = "root";
$senha = "";
$banco = "biblioteca";

$conn = new mysqli($host, $user, $senha, $banco);

if ($conn->connect_error) {
  die("Erro na conexão");
}
?>
