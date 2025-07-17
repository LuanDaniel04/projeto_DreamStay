<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['id'];

// Consulta os dados do usuário
$sql = "SELECT * FROM register WHERE id = $usuario_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result);
} else {
    die("Usuário não encontrado.");
}

$nomeUsuario = htmlspecialchars($usuario['nome'] ?? $usuario['email']);

// Consulta as reservas do usuário com dados do hotel/anuncio
$reservas_sql = "
  SELECT r.id, a.nome AS hotel_nome, a.localizacao
  FROM reservar r
  JOIN anuncios a ON r.hotel_id = a.id
  WHERE r.usuario_id = $usuario_id
  ORDER BY r.id DESC
";
$reservas_result = mysqli_query($conn, $reservas_sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Perfil - DreamStay</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body class="bg-dark text-light">

<nav class="navbar navbar-dark bg-dark p-3">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
    </a>
    <a class="btn btn-light" href="index.php">Voltar</a>
  </div>
</nav>

<div class="container perfil-page d-flex flex-column align-items-center pt-5 pb-5">

  <h2 class="perfil-nome mb-3">Olá, <?= explode(' ', $nomeUsuario)[0] ?> 👋</h2>

  <div class="perfil-links d-flex flex-wrap justify-content-center gap-3 mb-4">
    <a href="index.php" class="btn btn-primary perfil-btn">Início</a>
    <a href="editar_usuario.php" class="btn btn-primary perfil-btn">Editar Dados</a>
    <a href="favoritos.php" class="btn btn-primary perfil-btn">Favoritos</a>
    <a href="reservas.php" class="btn btn-primary perfil-btn">Minhas Reservas</a> <!-- Botão extra -->
  </div>

  <div class="mb-4 w-100">
    <h3>Minhas Reservas</h3>
    <?php if ($reservas_result && mysqli_num_rows($reservas_result) > 0): ?>
      <ul class="list-group">
        <?php while ($reserva = mysqli_fetch_assoc($reservas_result)): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong><?= htmlspecialchars($reserva['hotel_nome']) ?></strong> — <?= htmlspecialchars($reserva['localizacao']) ?>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p class="text-muted">Você ainda não tem reservas.</p>
    <?php endif; ?>
  </div>

  <a href="logout.php" class="btn btn-danger btn-lg mt-auto">Sair</a>
</div>

</body>
</html>
