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
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
</head>
<body>

  <h2>Editar Perfil</h2>

  <form action="alterar_usuario.php" method="post">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>

    <label for="senha">Nova Senha (opcional):</label>
    <input type="password" id="senha" name="senha" placeholder="Deixe em branco se não for mudar"><br><br>

    <button type="submit">Salvar Alterações</button>
  </form>

  <p><a href="logout.php">Sair da Conta</a></p>

</body>
</html>
