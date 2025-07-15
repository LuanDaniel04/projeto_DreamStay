<?php
session_start();
include_once("config.php");

// Verifica se está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id = $_POST['id'] ?? null;
if (!$id) {
    echo "Hotel inválido.";
    exit;
}

$usuario_id_logado = $_SESSION['id'];

// Busca o hotel com query direta e verifica dono
$sql = "SELECT * FROM anuncios WHERE id = $id AND usuario_id = $usuario_id_logado";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Hotel não encontrado ou acesso negado.";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Lista das possíveis tags/etiquetas
$opcoes_tags = [
    "ofertas" => "Ofertas imperdíveis",
    "melhores" => "Melhores avaliados",
    "talvez" => "Talvez você goste"
];

// Pega as tags salvas no banco (string separada por vírgula)
$tags_selecionadas = explode(',', $row['tags'] ?? '');

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Hotel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
  <h2>Editar Hotel</h2>

  <form action="update.php" method="post" enctype="multipart/form-data" class="mt-3">
    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />

    <div class="mb-3">
      <label for="nome" class="form-label">Nome:</label>
      <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($row['nome']) ?>" class="form-control" required />
    </div>

    <div class="mb-3">
      <label for="localizacao" class="form-label">Localização:</label>
      <input type="text" id="localizacao" name="localizacao" value="<?= htmlspecialchars($row['localizacao']) ?>" class="form-control" required />
    </div>

    <div class="mb-3">
      <label for="preco" class="form-label">Preço:</label>
      <input type="number" step="0.01" id="preco" name="preco" value="<?= htmlspecialchars($row['preco']) ?>" class="form-control" required />
    </div>

    <div class="mb-3">
      <label for="avaliacao" class="form-label">Avaliação:</label>
      <input type="text" id="avaliacao" name="avaliacao" value="<?= htmlspecialchars($row['avaliacao']) ?>" class="form-control" required />
    </div>

    <div class="mb-3">
      <label class="form-label">Etiquetas:</label><br />
      <?php foreach ($opcoes_tags as $valor => $label): ?>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="tag_<?= $valor ?>" name="tags[]" value="<?= $valor ?>"
            <?= in_array($valor, $tags_selecionadas) ? 'checked' : '' ?> />
          <label class="form-check-label" for="tag_<?= $valor ?>"><?= $label ?></label>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="mb-3">
      <label for="imagem_atual" class="form-label">Imagem Atual:</label><br />
      <img src="<?= htmlspecialchars($row['imagem']) ?>" alt="Imagem do hotel" style="max-width: 200px; height: auto;" />
    </div>

    <div class="mb-3">
      <label for="imagem" class="form-label">Trocar Imagem:</label>
      <input type="file" id="imagem" name="imagem" class="form-control" />
      <small class="form-text text-muted">Deixe em branco para manter a imagem atual.</small>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="dashboard.php" class="btn btn-secondary ms-2">Voltar</a>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
