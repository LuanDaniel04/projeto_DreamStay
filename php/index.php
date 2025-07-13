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

<?php 
session_start();
?>

  
<nav class="navbar navbar-dark bg-dark p-3">
  <div class="container-fluid d-flex align-items-center gap-3">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      DreamStay
    </a>
    <div class="d-flex mx-auto" style="max-width: 420px; width: 100%;">
      <input class="form-control" type="search" placeholder="Busque por cidade, estado ou nome" aria-label="Buscar" />
      <button class="btn btn-danger ms-2">Buscar</button>
    </div>
        <?php
        if (isset($_SESSION['email'])) {
          echo '<button class="btn btn-danger" onclick="location.href=\'logout.php\'">Sair</button>';
          if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
            echo '<button class="btn btn-danger" onclick="location.href=\'dashboard.php\'" >Anunciar</button>';
          }
        } else {
          ?>
          <button class="btn btn-primary"  onclick="location.href='login.php'">Entrar</button>
          <button class="btn btn-primary" onclick="location.href='cadastro.php'">Cadastrar</button>
          <?php
            }
          ?>
        
  </div>
</nav>



  <!-- Seção: Ofertas Imperdíveis (Carrossel Personalizado com JS) -->
  <div class="container mt-5" style="max-width: 900px;">
    <h4 class="mb-4">Ofertas Imperdíveis</h4>
    <div id="carouselPrincipal" class="position-relative mx-auto">
      <div id="carouselViewport" class="carousel-viewport mx-auto">
        <div id="carouselInner" class="carousel-inner d-flex align-items-stretch">
          <!-- Cards inseridos via JavaScript -->
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
  <div class="container mt-5" style="max-width: 900px;">
    <h4 class="mb-4">Melhores Avaliados</h4>
    <div class="row g-3">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card hotel-card h-100">
          <div id="carouselMelhor1" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/imagem1.jpg" class="d-block w-100" alt="Hotel Luxo 1" />
              </div>
              <div class="carousel-item">
                <img src="assets/imagem2.jpeg" class="d-block w-100" alt="Hotel Luxo 2" />
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMelhor1" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMelhor1" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Hotel Luxo</h5>
            <p class="avaliacao-text"><strong>Avaliação:</strong> 9.8 - Excelente</p>
            <p class="local-text">Florianópolis</p>
            <h5 class="text-danger">R$ 790</h5>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card hotel-card h-100">
          <div id="carouselMelhor2" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/imagem2.jpeg" class="d-block w-100" alt="Hotel Jardim 1" />
              </div>
              <div class="carousel-item">
                <img src="assets/imagem3.jpeg" class="d-block w-100" alt="Hotel Jardim 2" />
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMelhor2" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMelhor2" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Hotel Jardim</h5>
            <p class="avaliacao-text"><strong>Avaliação:</strong> 9.5 - Excelente</p>
            <p class="local-text">Búzios</p>
            <h5 class="text-danger">R$ 620</h5>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card hotel-card h-100">
          <div id="carouselMelhor3" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/imagem3.jpeg" class="d-block w-100" alt="Hotel Bela Vista 1" />
              </div>
              <div class="carousel-item">
                <img src="assets/imagem1.jpg" class="d-block w-100" alt="Hotel Bela Vista 2" />
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMelhor3" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMelhor3" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Hotel Bela Vista</h5>
            <p class="avaliacao-text"><strong>Avaliação:</strong> 9.4 - Excelente</p>
            <p class="local-text">Curitiba</p>
            <h5 class="text-danger">R$ 550</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Seção: Talvez Você Goste -->
  <div class="container mt-5 mb-5" style="max-width: 900px;">
    <h4 class="mb-4">Talvez Você Goste</h4>
    <div class="row g-3">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card hotel-card h-100">
          <div id="carouselSugestao1" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/imagem2.jpeg" class="d-block w-100" alt="Pousada Mar Azul 1" />
              </div>
              <div class="carousel-item">
                <img src="assets/imagem1.jpg" class="d-block w-100" alt="Pousada Mar Azul 2" />
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSugestao1" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSugestao1" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Pousada Mar Azul</h5>
            <p class="avaliacao-text"><strong>Avaliação:</strong> 8.7 - Muito Bom</p>
            <p class="local-text">Ilhabela</p>
            <h5 class="text-danger">R$ 450</h5>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card hotel-card h-100">
          <div id="carouselSugestao2" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/imagem3.jpeg" class="d-block w-100" alt="Hotel da Serra 1" />
              </div>
              <div class="carousel-item">
                <img src="assets/imagem1.jpg" class="d-block w-100" alt="Hotel da Serra 2" />
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSugestao2" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSugestao2" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Hotel da Serra</h5>
            <p class="avaliacao-text"><strong>Avaliação:</strong> 8.5 - Muito Bom</p>
            <p class="local-text">Petrópolis</p>
            <h5 class="text-danger">R$ 390</h5>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card hotel-card h-100">
          <div id="carouselSugestao3" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="assets/imagem1.jpg" class="d-block w-100" alt="Pousada do Vale 1" />
              </div>
              <div class="carousel-item">
                <img src="assets/imagem2.jpeg" class="d-block w-100" alt="Pousada do Vale 2" />
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSugestao3" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSugestao3" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Pousada do Vale</h5>
            <p class="avaliacao-text"><strong>Avaliação:</strong> 8.3 - Bom</p>
            <p class="local-text">Natal</p>
            <h5 class="text-danger">R$ 320</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Rodapé -->

<footer class="bg-dark text-white py-4 mt-5">
  <div class="container text-center">
    <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
    <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
  </div>
</footer>


  <!-- Scripts -->

    <!-- Pega os dados do php e envia para o js -->
   <script>
   const HOTEL_API_URL = "anuncios.php";
   </script>
   <!-- Js do bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JS do carousel -->
  <script src="js/carousel.js"></script>
</body>
</html>
