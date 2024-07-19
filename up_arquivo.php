<?php

$pasta = "./imagens/";

$nomeArq = $_FILES['arquivo']['name'];

if ($_FILES['arquivo']['size'] > 10000000) { //10M
    echo "arquivo muito grande";
    exit;
}

$extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

if ($extensao != "jpg" && $extensao != "png" && $extensao != "gif" && $extensao != "jfif" && $extensao != "svg") {
    echo "Isso nao é uma imagem";
    exit;
}

if (getimagesize($_FILES['arquivo']['tmp_name']) === false) {
    echo "Problemas ao enviar a imagem. Tente novamente.";
    die();
}

$nomearq = uniqid();

$fezupload = move_uploaded_file($_FILES['arquivo']['tmp_name'], __DIR__ . $pastadestino . $nomearq . "." . $extensao);

if ($fezupload == true) {
    $conexao = conectar();
    $sql = "INSERT INTO user (foto_perfil) VALUES ('$nomearq.$extensao')";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado != false) {
        // se for uma alteração de arquivo
        if (isset($_POST['foto_perfil'])) {
            $apagou = unlink(__DIR__ . $pastadestino . $_POST['foto_perfil']);
            if ($apagou == true) {
                $sql = "DELETE FROM user WHERE foto_perfil='" . $_POST['foto_perfil'] . "'";
                $resultado2 = mysqli_query($conexao, $sql);
                if ($resultado2 == false) {
                    echo "Erro ao apagar o arquivo do banco de dados.";
                    die();
                }
            } else {
                echo "Erro ao apagar o arquivo antigo.";
                die();
            }
        }
        header("location:inicial.php");
    } else {
        echo "erro ao mover arquivo";
    }
} else {
    echo "Erro ao registrar o arquivo no banco de dados.";
}
?>