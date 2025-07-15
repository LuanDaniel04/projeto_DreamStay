<?php
session_start();
include_once("config.php");

// Verifica se está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id = $_POST["id"];
$nome = $_POST["nome"];
$localizacao = $_POST["localizacao"];
$preco = $_POST["preco"];
$avaliacao = $_POST["avaliacao"];
$tags = isset($_POST['tags']) ? implode(',', $_POST['tags']) : '';

$usuario_id_logado = $_SESSION['id'];

$imagem = $_FILES["imagem"] ?? null;
$caminhoImagem = null;

// Verifica se o hotel pertence ao usuário logado (consulta direta)
$sql_check = "SELECT usuario_id FROM anuncios WHERE id = $id";
$result_check = mysqli_query($conn, $sql_check);

if (!$result_check || mysqli_num_rows($result_check) === 0) {
    die("Hotel não encontrado.");
}

$row = mysqli_fetch_assoc($result_check);
if ($row['usuario_id'] != $usuario_id_logado) {
    die("Acesso negado. Você não pode editar este hotel.");
}

if ($imagem && $imagem['error'] === 0) {
    $pasta = "uploads/";
    $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
    $nomeImagem = uniqid() . "." . $extensao;
    $caminhoImagem = $pasta . $nomeImagem;

    if (!move_uploaded_file($imagem['tmp_name'], $caminhoImagem)) {
        die("Erro ao fazer upload da imagem.");
    }

    $sql_update = "UPDATE anuncios SET 
        nome = '$nome',
        localizacao = '$localizacao',
        preco = $preco,
        avaliacao = '$avaliacao',
        imagem = '$caminhoImagem',
        tags = '$tags'
        WHERE id = $id AND usuario_id = $usuario_id_logado";
} else {
    $sql_update = "UPDATE anuncios SET 
        nome = '$nome',
        localizacao = '$localizacao',
        preco = $preco,
        avaliacao = '$avaliacao',
        tags = '$tags'
        WHERE id = $id AND usuario_id = $usuario_id_logado";
}

if (mysqli_query($conn, $sql_update)) {
    mysqli_close($conn);
    header("Location: dashboard.php");
    exit;
} else {
    echo "Erro ao atualizar hotel: " . mysqli_error($conn);
    mysqli_close($conn);
}
?>
