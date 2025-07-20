<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DreamStay - Login</title>
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


  <!-- Conteúdo Login -->
  <div class="main-content">
    <div class="container" style="max-width: 400px; margin-top: 6rem;">
      <h1 class="mb-4 text-center">Login</h1>
      <form id="loginForm" action="entrar.php" method="post">
        <div class="mb-3">
          <label for="emailInput" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="emailInput" name="email" placeholder="seu@email.com" required />
        </div>
        <div class="mb-3">
          <label for="passwordInput" class="form-label">Senha</label>
          <input type="password" class="form-control" id="passwordInput" name="senha" placeholder="Digite sua senha" required />
        </div>
        <button type="submit" class="btn btn-danger w-100">Entrar</button>
      </form>
      <p class="text-center mt-3">
        Não tem uma conta?
        <a href="cadastro.php">Cadastre-se aqui</a><br><br>
        Esqueceu sua senha? 
        <a href="senha.php">Clique aqui</a>
      </p>
    </div>
  </div>

  <!-- Rodapé -->
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
      <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
    </div>
  </footer>

  <!-- Scripts Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
