<?php

session_start();

require_once "conexao.php";
$conexao = conectar();

$nome = $_POST['nome'];
$_SESSION['nome'] = $nome;
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO user (nome, email, senha) VALUES
('$nome', '$email', '$senha')";
$resultado = mysqli_query($conexao, $sql);
if ($resultado === false){
    if ($mysqli_errno($conexao) == 1062){
        echo "Email já cadastrado no sistema!
            faça o login ou peça a recuperação de senha.";
                die();
    } else {
        echo "Erro ao inserir o novo usuario! " .
        mysqli_errno($conexao) . ": " . mysqli_error($conexao);
        die();
    }
}
header("Location: index.php")

?>