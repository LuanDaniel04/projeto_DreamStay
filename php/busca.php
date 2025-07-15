<?php

header('Content-Type: application/json; charset=utf-8');
include_once("config.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$termo = $_GET['termo'] ?? '';

if (empty($termo)) {
  echo json_encode([]);
  exit;
}

$busca = '%' . $termo . '%';

$sql = "SELECT * FROM anuncios WHERE nome LIKE '$busca' OR localizacao LIKE '$busca' ORDER BY id DESC";
$resultado = mysqli_query($conn, $sql);

$cards = [];

if ($resultado && mysqli_num_rows($resultado) > 0) {
  while ($row = mysqli_fetch_assoc($resultado)) {
    $cards[] = [
      "id" => $row["id"],
      "title" => $row["nome"],
      "rating" => $row["avaliacao"],
      "location" => $row["localizacao"],
      "offerText" => "Oferta exclusiva!",
      "price" => "R$ " . $row["preco"],
      "images" => [$row["imagem"]]
    ];
  }
  echo json_encode($cards, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} else {
  echo json_encode([]);
}

mysqli_close($conn);
?>
