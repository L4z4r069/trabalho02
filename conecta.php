<?php

function conectar()
{
    $conexao = mysqli_connect("localhost", "root", "", "trab2");
    if ($conexao == false) {
        echo "Erro ao conectar com o banco de dados. N° do erro:" .
            mysqli_connect_errno() . "." .
            mysqli_connect_errno();
        die();
    }
    return $conexao;
}

function executarSQL($conexao, $sql)
{
    $resultado = mysqlI_query($conexao, $sql);
    if ($resultado == false){
        echo "Erro ao executar o comando SQL. ".
        mysqli_errno($conexao) . ": " . mysqli_error($conexao);
        die();
    }
    return $resultado;
}
