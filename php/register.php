<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Impede que seja acessado direto na url
    
// Obtém os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirma = $_POST['confirmaSenha'];

// Segunda validação de senha
if ($senha !== $confirma) {
    echo "As senhas não coincidem";
    header("Location: cadastro.php");
    exit;
}

// Insere os dados no banco
$sql = "INSERT INTO register (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

if (mysqli_query($conn, $sql)) {
    $_SESSION['email'] = $email;
    $_SESSION['tipo'] = "visitante"; 

    header("Location: login.php");
    exit;
} else {
    echo "Erro ao Registrar: " . mysqli_error($conn);
}

}
