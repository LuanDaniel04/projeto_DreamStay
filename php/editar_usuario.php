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
  <title>Editar Perfil - DreamStay</title>
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

  <main class="perfil-page">
    <h2>Editar Perfil</h2>

    <form action="alterar_usuario.php" method="post" autocomplete="off">
      <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

      <label for="senha">Nova Senha (opcional):</label>
      <input type="password" id="senha" name="senha" placeholder="Deixe em branco se não for mudar">

      <button type="submit">Salvar Alterações</button>
    </form>

    <p class="sair-conta"><a href="logout.php">Sair da Conta</a></p>
  </main>

</body>
</html>
