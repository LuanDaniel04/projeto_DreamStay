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
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Adicionar Novo Hotel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
  <h3 class="mb-4 text-center">Adicionar Novo Hotel</h3>

  <form id="hotelForm" action="create.php" enctype="multipart/form-data" method="post" class="mx-auto" style="max-width: 500px;">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome do Hotel</label>
      <input type="text" class="form-control" id="nome" name="nome" required />
    </div>
    <div class="mb-3">
      <label for="localizacao" class="form-label">Localização</label>
      <input type="text" class="form-control" id="localizacao" name="localizacao" required />
    </div>
    <div class="mb-3">
      <label for="preco" class="form-label">Preço</label>
      <input type="number" class="form-control" id="preco" name="preco" required step="0.01" min="0" />
    </div>
    <div class="mb-3">
      <label for="avaliacao" class="form-label">Avaliação</label>
      <input type="text" class="form-control" id="avaliacao" name="avaliacao" placeholder="Ex: 9.5 - Excelente" required />
    </div>
    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Descrição do hotel..." required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Etiquetas:</label><br />
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="tag_ofertas" name="tags[]" value="ofertas" />
        <label class="form-check-label" for="tag_ofertas">Ofertas imperdíveis</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="tag_melhores" name="tags[]" value="melhores" />
        <label class="form-check-label" for="tag_melhores">Melhores avaliados</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="tag_talvez" name="tags[]" value="talvez" />
        <label class="form-check-label" for="tag_talvez">Talvez você goste</label>
      </div>
    </div>

    <div class="mb-3">
      <label for="imagem" class="form-label">Imagem</label>
      <input type="file" class="form-control" id="imagem" name="imagem" required />
    </div>
    <button type="submit" class="btn btn-success w-100">Salvar Hotel</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
