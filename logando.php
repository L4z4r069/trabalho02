<?php

require_once "conexao.php";
$conexao = conectar();

$nome = $_POST['nome'];
$senha = $_POST['senha'];

session_start();
$_SESSION['nome'] = $nome;

$sql = "SELECT * FROM user WHERE nome='$nome'";

$result = mysqli_query($conexao, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) {
    header('Location: inicial.php');
} else {
    echo "Usuario não encontrado";
}
