<?php
include_once("config.php");

$id = $_POST["id"];
$nome = $_POST["nome"];
$localizacao = $_POST["localizacao"];
$preco = $_POST["preco"];
$avaliacao = $_POST["avaliacao"];

$imagem = $_FILES["imagem"] ?? null;
$caminhoImagem = null;

if ($imagem && $imagem['error'] === 0) {
    $pasta = "uploads/";
    $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
    $nomeImagem = uniqid() . "." . $extensao;
    $caminhoImagem = $pasta . $nomeImagem;

    move_uploaded_file($imagem['tmp_name'], $caminhoImagem);

    // Atualiza com nova imagem
    $sql = "UPDATE anuncios 
            SET nome = '$nome', 
                localizacao = '$localizacao', 
                preco = '$preco', 
                avaliacao = '$avaliacao', 
                imagem = '$caminhoImagem' 
            WHERE id = '$id'";
} else {
    // Atualiza sem alterar a imagem
    $sql = "UPDATE anuncios 
            SET nome = '$nome', 
                localizacao = '$localizacao', 
                preco = '$preco', 
                avaliacao = '$avaliacao' 
            WHERE id = '$id'";
}

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Erro ao atualizar hotel: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
