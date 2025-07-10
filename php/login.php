<?php

session_start();

include_once("config.php");

if ($_SERVER["REQUEST_METHOD" == "POST"]) { //Impede que seja acessado direto na url

    // Obtém os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //consulta o banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '" . $email . "' and senha = '" . $senha . "'";
    $resultado = mysqli_query($conexao, $sql);
    
 if ($resultado && mysqli_num_rows($resultado) > 0) {
        $linha = mysqli_fetch_assoc($resultado);
        
        // Salva os dados na sessão
        $_SESSION['email'] = $linha['email'];
        $_SESSION['tipo'] = $linha['tipo'];
        
        header("Location: index.php");
    }
}

?>
