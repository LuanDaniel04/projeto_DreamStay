<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - Gerenciar Hotéis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <nav class="navbar navbar-dark bg-dark p-3">
    <div class="container-fluid d-flex align-items-center gap-3">
      <a class="navbar-brand d-flex align-items-center gap-2" href="home.html">
        <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
        DreamStay - Dashboard
      </a>
      <button class="btn btn-light ms-auto" onclick="location.href='index.php'">Voltar</button>
    </div>
  </nav>

  <div class="container mt-5">
    <h3 class="mb-4 text-center">Gerenciar Hotéis</h3>

    <!-- Formulário para adicionar ou editar hotéis -->
    <form id="hotelForm" class="mb-5">
      <input type="hidden" id="hotelId" />
      <div class="mb-3">
        <label for="nome" class="form-label">Nome do Hotel</label>
        <input type="text" class="form-control" id="nome" required />
      </div>
      <div class="mb-3">
        <label for="localizacao" class="form-label">Localização</label>
        <input type="text" class="form-control" id="localizacao" required />
      </div>
      <div class="mb-3">
        <label for="preco" class="form-label">Preço</label>
        <input type="number" class="form-control" id="preco" required />
      </div>
      <div class="mb-3">
        <label for="avaliacao" class="form-label">Avaliação</label>
        <input type="text" class="form-control" id="avaliacao" placeholder="Ex: 9.5 - Excelente" required />
      </div>
      <div class="mb-3">
        <label for="imagem" class="form-label">Imagem</label>
        <input type="file" class="form-control" id="avaliacao" required />
      </div>
      <button type="submit" class="btn btn-success w-100">Salvar Hotel</button>
    </form>

    <!-- Lista de hotéis cadastrados -->
    <div id="listaHoteis" class="row g-4"></div>
  </div>

  <!-- Rodapé -->
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
      <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/scripts.js"></script>
  </script>
</body>
</html>
