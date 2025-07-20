<?php
session_start();
include_once("config.php");

$id = $_POST['id'] ?? null;
$usuario_id_logado = $_SESSION['id'] ?? null;

if (!$id || !$usuario_id_logado) {
    echo "Dados inválidos.";
    exit;
}

// Busca o hotel
$sql = "SELECT * FROM anuncios WHERE id = $id AND usuario_id = $usuario_id_logado";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Hotel não encontrado.";
    exit;
}

$row = mysqli_fetch_assoc($result);
mysqli_close($conn);

$opcoes_tags = [
    "ofertas" => "Ofertas imperdíveis",
    "melhores" => "Melhores avaliados",
    "talvez" => "Talvez você goste"
];

$tags_selecionadas = explode(',', $row['tags'] ?? '');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Hotel - DreamStay</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark p-3">
    <div class="container-fluid justify-content-center">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
        <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
      </a>
    </div>
  </nav>

  <main class="perfil-page">

    <h2>Editar Hotel</h2>

    <form action="update.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />

      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($row['nome']) ?>" required />

      <label for="localizacao">Localização:</label>
      <input type="text" id="localizacao" name="localizacao" value="<?= htmlspecialchars($row['localizacao']) ?>" required />

      <label for="preco">Preço:</label>
      <input type="number" id="preco" class="form-control" name="preco" value="<?= htmlspecialchars($row['preco']) ?>" step="0.01" min="0" required />
  
      <label for="avaliacao">Avaliação:</label>
      <input type="text" id="avaliacao" name="avaliacao" value="<?= htmlspecialchars($row['avaliacao']) ?>" required />

      <label>Etiquetas:</label>
      <div>
        <?php foreach ($opcoes_tags as $valor => $label): ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="tag_<?= $valor ?>" name="tags[]" value="<?= $valor ?>"
            <?= in_array($valor, $tags_selecionadas) ? 'checked' : '' ?> />
            <label class="form-check-label" for="tag_<?= $valor ?>"><?= $label ?></label>
          </div>
        <?php endforeach; ?>
      </div>

      <label>Imagem Atual:</label><br />
      <img src="<?= htmlspecialchars($row['imagem']) ?>" alt="Imagem do hotel" style="max-width: 300px; height: auto; border-radius: 8px; margin-bottom: 10px;" />

      <label for="imagem">Trocar Imagem:</label>
      <input type="file" id="imagem" name="imagem" />
      <small>Deixe em branco para manter a imagem atual.</small>

      <button type="submit" class="perfil-btn mt-4">Salvar Alterações</button>
      <a href="dashboard.php" class="btn btn-secondary mt-3 w-100">Voltar</a>
    </form>
  </main>

  <footer class="bg-dark text-white py-4 mt-auto text-center">
    <div class="container">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
      <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
