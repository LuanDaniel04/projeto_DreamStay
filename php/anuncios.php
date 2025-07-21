<?php
include_once("config.php");

$cards = [];

$tag = isset($_GET['tag']) ? $_GET['tag'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;

// Monta a query base
$sql = "SELECT * FROM anuncios";
$conditions = [];

// Filtro por tag
if ($tag) {
    $conditions[] = "FIND_IN_SET('$tag', tags)";
}

// Filtro por texto
if ($search) {
    $searchParam = "%$search%";
    $conditions[] = "(nome LIKE '$searchParam' OR localizacao LIKE '$searchParam')";
}

// Adiciona o WHERE se necessário
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY id DESC";

$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $cards[] = [
            "id" => $row["id"],
            "title" => $row["nome"],
            "rating" => $row["avaliacao"],
            "location" => $row["localizacao"],
            "offerText" => "Oferta exclusiva!",
            "price" => "R$ " . number_format($row["preco"], 2, ',', '.'),
            "images" => [$row["imagem"]],
            "descricao" => $row["descricao"],
            "tags" => explode(',', $row["tags"])
        ];
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($cards, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} else {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([]);
}
?>
