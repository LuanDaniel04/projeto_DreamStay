<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Consulta direta sem prepared statement
    $sql = "SELECT id, email, tipo, senha FROM register WHERE email = '$email'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);

        // Senha simples (não recomendado, mas ok para curso)
        if ($senha === $dados['senha']) {
            $_SESSION['id'] = $dados['id'];          // Importante para o dashboard!
            $_SESSION['email'] = $dados['email'];
            $_SESSION['tipo'] = $dados['tipo'];

            header("Location: index.php");
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }

    mysqli_free_result($resultado);
}

mysqli_close($conn);
?>
