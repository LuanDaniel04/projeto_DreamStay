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
  <div class="container-fluid justify-content-center">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
    </a>
  </div>
</nav>

<div class="container perfil-page d-flex flex-column align-items-center pt-5 pb-5">

  <h2 class="perfil-nome mb-3">Olá, <?= explode(' ', $nomeUsuario)[0] ?> 👋</h2>

  <div class="perfil-links d-flex flex-wrap justify-content-center gap-3 mb-4">
    <a href="index.php" class="btn btn-primary perfil-btn">Início</a>
    <a href="editar_usuario.php" class="btn btn-primary perfil-btn">Editar Dados</a>
    <a href="favoritos.php" class="btn btn-primary perfil-btn">Favoritos</a>
    <a href="reservados.php" class="btn btn-primary perfil-btn">Minhas Reservas</a> 
  </div>

  <a href="logout.php" class="btn btn-danger btn-lg mt-auto">Sair</a>
</div>

</body>
</html>
