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
  <style>
    /* Ajustes específicos para o form de perfil */
    .perfil-page {
      max-width: 450px;
      margin: 60px auto 60px auto;
      padding: 40px 30px;
      background-color: #1b263b;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
      color: #e1e8f0;
      font-family: Arial, sans-serif;
    }

    .perfil-page h2 {
      color: #ffdd57;
      text-align: center;
      font-weight: 700;
      margin-bottom: 30px;
      text-shadow: 0 0 5px rgba(255, 221, 87, 0.7);
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #cfd8dc;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border-radius: 10px;
      border: none;
      font-size: 1rem;
      background-color: #2a3a56;
      color: #f5f8fa;
      box-shadow: inset 0 2px 6px rgba(0,0,0,0.4);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
      background-color: #3b4a6a;
      outline: none;
      box-shadow: 0 0 8px #ffdd57;
      color: #fff;
    }

    button[type="submit"] {
      width: 100%;
      background-color: #4a90e2;
      border: none;
      padding: 14px 0;
      font-size: 1.2rem;
      font-weight: 700;
      color: white;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 0 4px 15px rgba(74,144,226,0.7);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #357abd;
      box-shadow: 0 6px 20px rgba(53,122,189,0.9);
    }

    p.sair-conta {
      margin-top: 25px;
      text-align: center;
      font-size: 1rem;
    }

    p.sair-conta a {
      color: #ff5e5e;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    p.sair-conta a:hover {
      color: #ff3535;
      text-decoration: underline;
    }

    /* Responsividade */
    @media (max-width: 480px) {
      .perfil-page {
        margin: 40px 15px;
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
    </a>
    <a class="btn btn-light" href="index.php">Voltar</a>
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
