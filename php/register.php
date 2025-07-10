<?php 

include_once("config.php");
   
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Insere os dados no banco
    $sql = "INSERT INTO register (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php"); // Redireciona pro login
        exit;
    } else {
        echo "Erro ao Registrar: " . mysqli_error($conn);
    }

?>
