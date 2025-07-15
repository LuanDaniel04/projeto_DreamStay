<?php
session_start();
include_once("config.php");

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

// Busca o hotel direto com mysqli_query
$sql = "SELECT * FROM anuncios WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Hotel não encontrado.";
    exit;
}

$row = mysqli_fetch_assoc($result);

$eh_dono = ($row['usuario_id'] == $usuario_id_logado);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detalhes do Hotel - <?= htmlspecialchars($row['nome']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
  <div class="container-fluid d-flex align-items-center gap-3">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
    </a>
    <button class="btn btn-light ms-auto" onclick="location.href='dashboard.php'">Voltar</button>
  </div>
</nav>

<div class="container mt-5 d-flex justify-content-center">
  <div class="card hotel-card hotel-card-detalhes">
    <img src="<?= htmlspecialchars($row['imagem']) ?>" alt="<?= htmlspecialchars($row['nome']) ?>" />

    <div class="card-body">
      <h3 class="card-title"><?= htmlspecialchars($row['nome']) ?></h3>

      <p class="avaliacao-text"><strong>Avaliação:</strong> <?= htmlspecialchars($row['avaliacao']) ?></p>
      <p class="local-text"><strong>Localização:</strong> <?= htmlspecialchars($row['localizacao']) ?></p>
      <p class="text-danger"><strong>Preço:</strong> R$ <?= number_format($row['preco'], 2, ',', '.') ?></p>

      <hr />

      <p class="card-text">
        <?= nl2br(htmlspecialchars($row['descricao'])) ?>
      </p>

      <?php if ($eh_dono): ?>
        <div class="btn-group">
          <form action="editar.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />
            <button type="submit" class="btn btn-primary">Editar</button>
          </form>

          <form action="delete.php" method="post" onsubmit="return confirm('Tem certeza que deseja deletar este hotel?');">
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />
            <button type="submit" class="btn btn-danger">Deletar</button>
          </form>
        </div>
      <?php else: ?>
        <p class="text-center fst-italic mt-3" style="color: #bbb;">
          Você não tem permissão para editar ou deletar este hotel.
        </p>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="container text-center mt-4 mb-5">
  <a href="dashboard.php" class="btn btn-secondary">← Voltar ao Dashboard</a>
</div>

<footer class="bg-dark text-white py-4 mt-5">
  <div class="container text-center">
    <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
    <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
