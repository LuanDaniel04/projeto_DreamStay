<?php
session_start();
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o usuário está logado
    if (!isset($_SESSION['id'])) {
        die("Usuário não está logado.");
    }

    // Obtem os dados do formulario
    $nome = $_POST['nome'];
    $locate = $_POST['localizacao'];
    $preco = $_POST['preco'];
    $avaliacao = $_POST['avaliacao'];
    $descricao = $_POST['descricao']; // Novo campo
    $img = $_FILES['imagem'];

    // Recebe as tags (array), transforma em string separada por vírgula
    $tags = isset($_POST['tags']) ? implode(',', $_POST['tags']) : '';

    // Pega o ID do usuário logado da sessão
    $usuario_id = $_SESSION['id'];

    // Pasta onde a img vai ser salva
    $pasta = "uploads/";

    // Gera um nome unico para a imagem
    $extensao = pathinfo($img['name'], PATHINFO_EXTENSION);
    $nome_img = uniqid() . "." . $extensao;

    // Move a img para a pasta
    if (!move_uploaded_file($img['tmp_name'], $pasta . $nome_img)) {
        die("Erro ao fazer upload da imagem.");
    }

    $caminho = $pasta . $nome_img;

    // Prepara a query com prepared statements para segurança
    // Acrescenta o campo descricao e tags na query e no bind_param
    $stmt = $conn->prepare("INSERT INTO anuncios (nome, localizacao, preco, avaliacao, descricao, imagem, tags, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdssssi", $nome, $locate, $preco, $avaliacao, $descricao, $caminho, $tags, $usuario_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao Salvar: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($conn);
} else {
  header("Location: index.php");
  exit;
}
?> 

