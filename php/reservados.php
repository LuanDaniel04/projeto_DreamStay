<?php
session_start();
include_once('config.php');

$usuario_id = $_SESSION['id'];

$sql = "SELECT anuncios.* FROM reservar JOIN anuncios ON reservar.hotel_id = anuncios.id WHERE reservar.usuario_id = " . $usuario_id;
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DreamStay - Reservas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body class="min-vh-100 d-flex flex-column">

  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark p-3">
    <div class="container-fluid justify-content-center">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
        <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
      </a>
    </div>
  </nav>

  <!-- Conteúdo principal -->
  <div class="container flex-grow-1 py-4">
    <h2 class="text-center">Boa sorte para deixar essa tela bonita, minha parte eu fiz, tá tudo funcionando, vagabunda.</h2>

    <div class="d-flex flex-wrap gap-4 justify-content-center mt-4">
      <?php while ($dados = mysqli_fetch_assoc($result)) { ?>
        <div class="card hotel-card" style="width: 18rem;">
          <?php if (!empty($dados['imagem'])): ?>
            <img src="<?= htmlspecialchars($dados['imagem']); ?>" class="card-img-top" alt="<?= htmlspecialchars($dados['nome']); ?>">
          <?php else: ?>
            <img src="caminho/para/imagem-padrao.jpg" class="card-img-top" alt="Imagem padrão">
          <?php endif; ?>

          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($dados['nome']); ?></h5>
            <p class="card-text"><strong>Localização:</strong> <?= htmlspecialchars($dados['localizacao']); ?></p>
            <p class="card-text"><strong>Preço:</strong> R$ <?= number_format($dados['preco'], 2, ',', '.'); ?></p>
            <p class="card-text"><strong>Avaliação:</strong> <?= htmlspecialchars($dados['avaliacao'] ?? 'N/A'); ?></p>
            <?php if (!empty($dados['descricao'])): ?>
              <p class="card-text"><?= nl2br(htmlspecialchars($dados['descricao'])); ?></p>
            <?php endif; ?>
            <?php if (!empty($dados['tags'])): ?>
              <p class="card-text"><small class="text-muted">Tags: <?= htmlspecialchars($dados['tags']); ?></small></p>
            <?php endif; ?>

            <form action="detalhes.php" method="post">
              <input type="hidden" name="id" value="<?= $dados['id']; ?>">
              <button type="submit" class="btn btn-info">Ver Detalhes</button>
            </form>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <!-- Rodapé -->
  <footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
      <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
    </div>
  </footer>

</body>
</html>
