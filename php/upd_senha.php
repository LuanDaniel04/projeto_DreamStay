<?php
include_once("config.php");

$email = $_POST['email'];
$novaSenha = $_POST['Upd_senha'];
$confirmaSenha = $_POST['verifica_senha'];

// Se as senhas não baterem, cancela
if ($novaSenha !== $confirmaSenha) {
    die("As senhas não coincidem.");
}

// Atualiza direto
$sql = "UPDATE register SET senha = '$novaSenha' WHERE email = '$email'";

if (mysqli_query($conn, $sql)) {
    header("Location: login.php");
    exit;
} else {
    echo "Erro ao atualizar senha: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
