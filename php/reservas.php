<?php
session_start();
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit;
    }

    $usuario_id = $_SESSION['id'];
    $hotel_id = $_POST["hotel_id"];
    $retorno = $_POST['retorno'] ?? 'index.php';

    // Verifica se a reserva já foi feita
    $check = mysqli_query($conn, "SELECT * FROM reservar WHERE usuario_id = $usuario_id AND hotel_id = $hotel_id");

    $sql_insert = "INSERT INTO reservar (usuario_id, hotel_id) VALUES ($usuario_id, $hotel_id)";
    $sql_delete = "DELETE FROM reservar WHERE usuario_id = $usuario_id AND hotel_id = $hotel_id";

    if (mysqli_num_rows($check) > 0) {
        // Já está reservado
        mysqli_query($conn, $sql_delete);
    } else {
        // Ainda não foi reservado
        mysqli_query($conn, $sql_insert);
    }

    header("Location: $retorno");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
