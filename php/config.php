<?php 

//Dados para conexão
$host = "localhost";
$user = "root";
$pass = "";
$db = "dreamstay"; //Alterar apos o vini concluir o banco

//Conexão com o banco de dados
$conn = mysqli_connect($host, $user, $pass, $db);


//Verifica se a conexão foi bem sucedida
if (!$conn) {
    die("Falha na conexão".mysqli_connect_error());
}

?>

php