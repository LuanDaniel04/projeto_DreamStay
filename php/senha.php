<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DreamStay - Atualizar Senha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark p-3">
  <div class="container-fluid justify-content-center">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
    </a>
  </div>
</nav>


<!-- Formulário de atualização de senha -->
<div class="container" style="max-width: 400px; margin-top: 6rem;">
  <h3 class="mb-4 text-center">Esqueci minha Senha</h3>
  <form action="upd_senha.php" method="post">
    <div class="mb-3">
      <label for="email" class="form-label">E-mail</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Insira seu e-mail" required>
    </div>

    <div class="mb-3">
      <label for="novaSenha" class="form-label">Nova Senha</label>
      <input type="password" class="form-control" id="novaSenha" name="Upd_senha" placeholder="Insira sua nova senha" required>
    </div>

    <div class="mb-3">
      <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
      <input type="password" class="form-control" id="confirmarSenha" name="verifica_senha" placeholder="Confirme sua senha" required>
    </div>

    <button type="submit" class="btn btn-danger w-100">Confirmar nova senha</button>
  </form>
</div>

<!-- Rodapé -->
<footer class="bg-dark text-white py-4 mt-5">
  <div class="container text-center">
    <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
    <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
