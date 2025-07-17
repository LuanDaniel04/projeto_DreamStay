<?php
session_start();
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id'])) {
        die("Você precisa estar logado para reservar.");
    }

    $usuario_id = $_SESSION['id'];
    $hotel_id = $_POST["hotel_id"];

    // Verifica se a reserva ja foi feita
    $check = mysqli_query($conn, "SELECT * FROM reservar WHERE usuario_id = $usuario_id AND hotel_id = $hotel_id");
    if (mysqli_num_rows($check) > 0) {
        die("Você já reservou esse hotel.");
    }

    $sql = "INSERT INTO reservar (usuario_id, hotel_id) VALUES ($usuario_id, $hotel_id)";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao reservar: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit;
}
?>
