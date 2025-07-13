<?php
session_start();
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
//Obtem os dados do formulario
$nome = $_POST['nome'];
$locate = $_POST['localizacao'];
$preco = $_POST['preco'];
$avaliacao = $_POST['avaliacao'];
$img = $_FILES['imagem'];

//Pasta onde a img vai ser salva
$pasta = "uploads/";

//Gera um nome unico para a imagem
$extensao = pathinfo($img['name'],PATHINFO_EXTENSION);
$nome_img = uniqid() . "." . $extensao;

//Move a img para a pasta
move_uploaded_file($img['tmp_name'], $pasta.$nome_img);

$caminho = $pasta . $nome_img;

//inserir no banco
$sql = "INSERT INTO anuncios (nome, localizacao, preco, avaliacao, imagem)
 VALUES ('$nome', '$locate', '$preco', '$avaliacao', '$caminho')";

 if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
 } else {
    echo "Erro ao Salvar: " . mysqli_error($conn);
 }
}

mysqli_close($conn);
?>