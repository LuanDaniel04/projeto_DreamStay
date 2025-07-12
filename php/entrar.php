<?php

session_start();

include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Impede que seja acessado direto na url

    // Obtém os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //consulta o banco de dados
    $sql = "SELECT * FROM register WHERE email = '" . $email . "' and senha = '" . $senha . "'";
    $resultado = mysqli_query($conn, $sql);
    
 if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        
        // Salva os dados na sessão
        $_SESSION['email'] = $dados['email'];
        $_SESSION['tipo'] = $dados['tipo'];
        
        header("Location: index.php");
    }
}

?>
