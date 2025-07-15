<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DreamStay - Hotéis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<?php session_start(); ?>

<nav class="navbar navbar-dark bg-dark p-3">
  <div class="container-fluid d-flex align-items-center gap-3">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      <img src="assets/DreamStay2.png" alt="DreamStay" width="150" style="object-fit: contain;" />
      
    </a>
    <div class="d-flex mx-auto" style="max-width: 420px; width: 100%;">
      <input id="campoBusca" class="form-control" type="search" placeholder="Busque por cidade, estado ou nome" aria-label="Buscar" />
      <button id="botaoBusca" class="btn btn-danger ms-2">Buscar</button>
    </div>
    <?php
      if (isset($_SESSION['email'])) {
        echo '<button class="btn btn-danger" id="custom" onclick="location.href=\'perfil.php\'">Perfil</button>';
        if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
          echo '<button class="btn btn-danger" onclick="location.href=\'dashboard.php\'">Anunciar</button>';
        }
      } else {
        echo '<button class="btn btn-primary" onclick="location.href=\'login.php\'">Entrar</button>';
        echo '<button class="btn btn-primary" onclick="location.href=\'cadastro.php\'">Cadastrar</button>';
      }
    ?>
  </div>
</nav>

<!-- RESULTADO DA BUSCA -->
<div class="container mt-4" id="resultadoBusca" style="max-width: 900px; display: none;">
  <h4 class="mb-4">Resultado da Busca</h4>
  <div class="row" id="resultadoCards">
    <!-- Cards inseridos por AJAX -->
  </div>
</div>

<!-- Seção: Ofertas Imperdíveis -->
<div class="container mt-5" style="max-width: 900px;" id="secaoOfertas">
  <h4 class="mb-4">Ofertas Imperdíveis</h4>
  <div id="carouselPrincipal" class="position-relative mx-auto">
    <div id="carouselViewport" class="carousel-viewport mx-auto">
      <div id="carouselInner" class="carousel-inner d-flex align-items-stretch">
        <!-- Aqui os cards serão inseridos dinamicamente via JS -->
      </div>
    </div>
    <button id="prevBtn" class="carousel-control-prev" type="button" aria-label="Anterior">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button id="nextBtn" class="carousel-control-next" type="button" aria-label="Próximo">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<!-- Seção: Melhores Avaliados -->
<div class="container mt-5" style="max-width: 900px;" id="secaoMelhores">
  <h4 class="mb-4">Melhores Avaliados</h4>
  <div class="row g-3">
    <!-- Cards fixos, mantidos exatamente como você tinha -->
  </div>
</div>

<!-- Seção: Talvez Você Goste -->
<div class="container mt-5 mb-5" style="max-width: 900px;" id="secaoTalvez">
  <h4 class="mb-4">Talvez Você Goste</h4>
  <div class="row g-3">
    <!-- Cards fixos, mantidos exatamente como você tinha -->
  </div>
</div>

<!-- Rodapé -->
<footer class="bg-dark text-white py-4 mt-5">
  <div class="container text-center">
    <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
    <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
  </div>
</footer>

<!-- Constante com URL do PHP para o AJAX -->
<script>
  const HOTEL_API_URL = "anuncios.php";
</script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Carousel personalizado -->
<script src="js/carousel.js"></script>

<!-- AJAX e busca -->
<script src="js/ajax.js"></script>

</body>
</html>
