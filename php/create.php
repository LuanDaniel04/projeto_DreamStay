<?php
session_start();
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id'])) {
        die("Usuário não está logado.");
    }

    // Dados do formulário (sem escapar nem sanitizar)
    $nome = $_POST['nome'];
    $locate = $_POST['localizacao'];
    $preco = $_POST['preco'];
    $avaliacao = $_POST['avaliacao'];
    $descricao = $_POST['descricao'];
    $img = $_FILES['imagem'];
    $tags = isset($_POST['tags']) ? implode(',', $_POST['tags']) : '';
    $usuario_id = $_SESSION['id'];

    $pasta = "uploads/";
    $extensao = pathinfo($img['name'], PATHINFO_EXTENSION);
    $nome_img = uniqid() . "." . $extensao;

    if (!move_uploaded_file($img['tmp_name'], $pasta . $nome_img)) {
        die("Erro ao fazer upload da imagem.");
    }

    $caminho = $pasta . $nome_img;

    // Monta a query sem prepared statement
    $sql = "INSERT INTO anuncios (nome, localizacao, preco, avaliacao, descricao, imagem, tags, usuario_id) 
            VALUES ('$nome', '$locate', $preco, $avaliacao, '$descricao', '$caminho', '$tags', $usuario_id)";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao Salvar: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: index.php");
    exit;
}
?>
