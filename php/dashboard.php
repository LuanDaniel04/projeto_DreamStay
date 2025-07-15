<?php
session_start();
include_once('config.php');

// Verifica se está logado e é admin
if (!isset($_SESSION['email']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['id'];

// Busca os hotéis desse usuário
$sql = "SELECT * FROM anuncios WHERE usuario_id = $usuario_id ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - Gerenciar Hotéis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <script>
    function confirmarDelete(nomeHotel) {
      return confirm('Tem certeza que deseja deletar o hotel "' + nomeHotel + '"?');
    }
  </script>
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
  <div class="container-fluid d-flex align-items-center gap-3">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain;" />
      DreamStay - Dashboard
    </a>
    <button class="btn btn-light ms-auto" onclick="location.href='index.php'">Voltar</button>
  </div>
</nav>

<div class="container mt-5">
  <h3 class="mb-4 text-center">Seus Hotéis</h3>

  <?php if ($result->num_rows === 0): ?>
    <p class="text-center">Você ainda não cadastrou nenhum hotel.</p>
  <?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
      <?php while ($hotel = $result->fetch_assoc()): ?>
        <div class="col">
          <div class="card admin-hotel-card h-100">

            <img src="<?php echo htmlspecialchars($hotel['imagem']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($hotel['nome']); ?>" style="height:200px; object-fit: cover;" />
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?php echo htmlspecialchars($hotel['nome']); ?></h5>
              <p class="card-text mb-1"><strong>Localização:</strong> <?php echo htmlspecialchars($hotel['localizacao']); ?></p>
              <p class="card-text mb-1"><strong>Preço:</strong> R$ <?php echo number_format($hotel['preco'], 2, ',', '.'); ?></p>
              <p class="card-text mb-1"><strong>Avaliação:</strong> <?php echo htmlspecialchars($hotel['avaliacao']); ?></p>
              <p class="card-text mb-1"><strong>Tags:</strong>
                <?php 
                  if (!empty($hotel['tags'])) {
                    $tags_array = explode(',', $hotel['tags']);
                    foreach ($tags_array as $tag) {
                      echo '<span class="badge bg-primary me-1 text-capitalize">' . htmlspecialchars(trim($tag)) . '</span>';
                    }
                  } else {
                    echo '<em>Nenhuma tag</em>';
                  }
                ?>
              </p>
              <p class="card-text mb-3" style="color: #cfd8dc; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                <?php echo htmlspecialchars($hotel['descricao']); ?>
              </p>
              <div class="mt-auto d-flex justify-content-between">
                <form action="detalhes.php" method="post" style="display:inline;">
                  <input type="hidden" name="id" value="<?php echo $hotel['id']; ?>" />
                  <button type="submit" class="btn btn-info btn-sm">Detalhes</button>
                </form>

                <form action="editar.php" method="post" style="display:inline;">
                  <input type="hidden" name="id" value="<?php echo $hotel['id']; ?>" />
                  <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                </form>

                <form action="delete.php" method="post" style="display:inline;" onsubmit="return confirmarDelete('<?php echo addslashes(htmlspecialchars($hotel['nome'])); ?>')">
                  <input type="hidden" name="id" value="<?php echo $hotel['id']; ?>" />
                  <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>

  <hr />

  <h3 class="mb-4 text-center">Adicionar Novo Hotel</h3>

  <form id="hotelForm" action="create.php" enctype="multipart/form-data" method="post" class="mx-auto" style="max-width: 500px;">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome do Hotel</label>
      <input type="text" class="form-control" id="nome" name="nome" required />
    </div>
    <div class="mb-3">
      <label for="localizacao" class="form-label">Localização</label>
      <input type="text" class="form-control" id="localizacao" name="localizacao" required />
    </div>
    <div class="mb-3">
      <label for="preco" class="form-label">Preço</label>
      <input type="number" class="form-control" id="preco" name="preco" required step="0.01" min="0" />
    </div>
    <div class="mb-3">
      <label for="avaliacao" class="form-label">Avaliação</label>
      <input type="text" class="form-control" id="avaliacao" name="avaliacao" placeholder="Ex: 9.5 - Excelente" required />
    </div>
    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Descrição do hotel..." required></textarea>
    </div>
    <div class="mb-3">
      <label for="imagem" class="form-label">Imagem</label>
      <input type="file" class="form-control" id="imagem" name="imagem" required />
    </div>
    <div class="mb-3">
      <label class="form-label">Tags (selecione uma ou mais):</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="tagOfertas" name="tags[]" value="ofertas imperdiveis" />
        <label class="form-check-label" for="tagOfertas">Ofertas imperdíveis</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="tagMelhores" name="tags[]" value="melhores avaliados" />
        <label class="form-check-label" for="tagMelhores">Melhores avaliados</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="tagTalvez" name="tags[]" value="talvez voce goste" />
        <label class="form-check-label" for="tagTalvez">Talvez você goste</label>
      </div>
    </div>
    <button type="submit" class="btn btn-success w-100">Salvar Hotel</button>
  </form>
</div>

<footer class="bg-dark text-white py-4 mt-5">
  <div class="container text-center">
    <img src="assets/Logo2.png" alt="Logo DreamStay" width="60" height="60" style="object-fit: contain; margin-bottom: 10px;" />
    <div style="opacity: 0.7;">&copy; 2025 DreamStay. Todos os direitos reservados.</div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
