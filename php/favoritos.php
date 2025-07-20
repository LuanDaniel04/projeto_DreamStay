<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['id'];

$sql = "SELECT a.* FROM favoritos f 
        JOIN anuncios a ON f.hotel_id = a.id 
        WHERE f.usuario_id = $usuario_id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Meus Favoritos - DreamStay</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <nav class="navbar navbar-dark bg-dark p-3">
  <div class="container-fluid justify-content-center">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
    </a>
  </div>
</nav>

<div class="container mt-5" style="max-width: 900px;">
  <h3 class="text-center mb-4">💙 Meus Hotéis Favoritos</h3>
  <div class="row g-4">
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-6">
          <div class="card hotel-card">
            <img src="<?= htmlspecialchars($row['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nome']) ?>" />
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['nome']) ?></h5>
              <p class="card-text"><strong>Localização:</strong> <?= htmlspecialchars($row['localizacao']) ?></p>
              <p class="text-danger"><strong>Preço:</strong> R$ <?= number_format($row['preco'], 2, ',', '.') ?></p>
              <form action="detalhes.php" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                <button type="submit" class="btn btn-primary w-100">Ver Detalhes</button>
              </form>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12 text-center text-danger">
  <p>Você ainda não adicionou nenhum hotel aos favoritos.</p>
      </div>

    <?php endif; ?>
  </div>
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
