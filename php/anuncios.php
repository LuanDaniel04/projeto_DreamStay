<?php

include_once("config.php");

$cards = [];

$sql = "SELECT * FROM anuncios ORDER BY id DESC";
$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
  while ($row = mysqli_fetch_assoc($resultado)) {
    $cards[] = [
      "title" => $row["nome"],
      "rating" => $row["avaliacao"],
      "location" => $row["localizacao"],
      "offerText" => "Oferta exclusiva!",
      "price" => "R$ " . $row["preco"],
      "images" => [$row["imagem"]]
    ];
  }
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($cards, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} else {
    http_response_code(500);
    echo json_encode(["erro" => "Erro na consulta SQL ou nenhum dado encontrado"]);
}

?>
