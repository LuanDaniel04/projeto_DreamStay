<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DreamStay - Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark p-3">
    <div class="container-fluid d-flex align-items-center gap-3">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
        DreamStay
      </a>
      <div class="d-flex mx-auto" style="max-width: 420px; width: 100%;">
        <input class="form-control" type="search" placeholder="Busque por cidade, estado ou nome" aria-label="Buscar" />
        <button class="btn btn-danger ms-2">Buscar</button>
      </div>
      <button class="btn btn-primary" onclick="location.href='login.php'">Entrar</button>
    </div>
  </nav>

  <div class="container mt-5" style="max-width: 480px;">
    <h4 class="mb-4">Cadastro</h4>

    <form id="formCadastro" method="post" action="register.php">
      <!-- Campos comuns -->
      <div class="mb-3">
        <label for="nomeInput" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nomeInput" name="nome" required placeholder="Seu nome completo" />
      </div>

      <div class="mb-3">
        <label for="emailInput" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="emailInput" name="email" required placeholder="seu@email.com" />
      </div>

      <div class="mb-3">
        <label for="senhaInput" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senhaInput" name="senha" required minlength="6" placeholder="Digite sua senha" />
      </div>

      <div class="mb-3">
        <label for="confirmaSenhaInput" class="form-label">Confirmar Senha</label>
        <input type="password" class="form-control" id="confirmaSenhaInput" name="confirmaSenha" required minlength="6" placeholder="Repita sua senha" />
      </div>

      <!-- Botão para mudar para cadastro vendedor -->
      <!-- <div class="mb-3">
        <button type="button" id="btnToggleVendedor" class="btn btn-outline-primary w-100">Sou vendedor</button>
      </div> -->

      <!-- Campos extras para vendedores, inicialmente escondidos -->
      <!-- <div id="camposVendedor" style="display: none;">
        <div class="mb-3">
          <label for="telefoneInput" class="form-label">Telefone</label>
          <input type="tel" class="form-control" id="telefoneInput" name="telefone" placeholder="(00) 00000-0000" />
        </div>
        <div class="mb-3">
          <label for="cnpjInput" class="form-label">CNPJ</label>
          <input type="text" class="form-control" id="cnpjInput" name="cnpj" placeholder="00.000.000/0000-00" />
        </div>
        <div class="mb-3">
          <label for="nomeEmpresaInput" class="form-label">Nome da Empresa</label>
          <input type="text" class="form-control" id="nomeEmpresaInput" name="nomeEmpresa" placeholder="Nome da sua empresa" />
        </div>
      </div> -->

      <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
    </form>
  </div>

  <!-- Rodapé -->
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
      <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/scripts.js"></script>
</body>
</html>
