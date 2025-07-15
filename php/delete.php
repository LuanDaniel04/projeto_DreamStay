<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id'])) {
        // Usuário não logado
        header("Location: login.php");
        exit;
    }

    $id = $_POST['id'];
    $usuario_id_logado = $_SESSION['id'];

    // Verifica se o hotel pertence ao usuário logado
    $sql_check = "SELECT usuario_id FROM anuncios WHERE id = $id";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) === 0) {
        die("Hotel não encontrado.");
    }

    $row = mysqli_fetch_assoc($result_check);
    if ($row['usuario_id'] != $usuario_id_logado) {
        die("Acesso negado. Você não pode deletar este hotel.");
    }

    // Agora pode deletar
    $sql_delete = "DELETE FROM anuncios WHERE id = $id";
    if (mysqli_query($conn, $sql_delete)) {
        mysqli_close($conn);
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Erro ao deletar: " . mysqli_error($conn);
    }

} else {
    // Método inválido - redireciona para dashboard
    header("Location: dashboard.php");
    exit;
}

mysqli_close($conn);
?>
