<?php

include_once "conexao.php";
$conexao = conectar();

$sql = "SELECT * FROM user";
$result = mysqli_query($conexao, $sql);
if ($result != false) {
    $arquivos = mysqli_fetch_all($result, MYSQLI_BOTH);
} else {
    echo "Erro ao executar o comando SQL.";
    die();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logado</title>
</head>

<body>
    <h1> Você está logado! </h1>
    <form action="" method="post">
        Coloque um foto de perfil: <input type="file" name="arquivo"><br>
        <input type="submit" value="Upload Image" bname="submit">
    </form>
    <br><br>
    <table border="2">
        <thead>
            <tr>
                <th colspan="1">Nome arquivo</th>
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($arquivos as $arquivo) {
                $arq = $arquivo['foto_perfil'];

                echo "<tr><td><img src='imagens/$arq' width='50px' height='50px'></td>";
                echo "<a href='uploads/$arq'>$arq</a>"; // 1ª coluna  com o nome do arquivo
                echo "<td><a href='alterar?foto_perfil=$arq'>Alterar </a></td>"; //Inserir o link
                echo "<td> <button onclick='excluir(\"$arq\");'>Excluir</button></td></tr>"; // Chamamos a função excluir
            }
            ?>
        </tbody>
    </table>

    <script>

        function excluir(foto_perfil) {
            let deletar = confirm("Você tem certeza que deseja excluir o arquivo " + foto_perfil + "?");
            if (deletar == true) {
                window.location.href = "deletar.php?nome_arquivo=" + foto_perfil;
            }
        }

    </script>

</body>

</html>