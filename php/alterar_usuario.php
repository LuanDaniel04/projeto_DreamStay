<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Monta a query com ou sem senha
    if (!empty($senha)) {
        $sql = "UPDATE register SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = $id";
    } else {
        $sql = "UPDATE register SET nome = '$nome', email = '$email' WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: perfil.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
} else {
    echo "Requisição inválida.";
}
?>
