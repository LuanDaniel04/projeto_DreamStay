<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['id'];
$hotel_id = $_POST['hotel_id'] ?? null;
$retorno = $_POST['retorno'] ?? 'index.php';

if (!$hotel_id) {
    echo "ID do hotel inválido.";
    exit;
}

// Verifica se já é favorito
$check = mysqli_query($conn, "SELECT * FROM favoritos WHERE usuario_id = $usuario_id AND hotel_id = $hotel_id");

if (mysqli_num_rows($check) > 0) {
    // Já é favorito, remove
    mysqli_query($conn, "DELETE FROM favoritos WHERE usuario_id = $usuario_id AND hotel_id = $hotel_id");
} else {
    // Não é favorito, adiciona
    mysqli_query($conn, "INSERT INTO favoritos (usuario_id, hotel_id) VALUES ($usuario_id, $hotel_id)");
}

header("Location: $retorno");
exit;
?>
