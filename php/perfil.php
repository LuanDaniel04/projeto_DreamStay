<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['id'];
$sql = "SELECT * FROM register WHERE id = $usuario_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result);
} else {
    die("Usuário não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Perfil - DreamStay</title>
</head>
<body>

  <a href="index.php"> <h3>Meu Perfil</h3></a>

  <p><strong>ID:</strong> <?= $usuario['id'] ?></p>

  <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>

  <p><strong>Tipo de Conta:</strong> <?= htmlspecialchars($usuario['tipo']) ?></p>

  <p><a href="logout.php">Sair da Conta</a></p>
  <p><a href="editar_usuario.php">Editar dados</a></p>
  <p><a href="favoritos.php">Favoritos</a></p>

</body>
</html>
