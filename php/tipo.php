<?php
session_start();
include_once("config.php");

$id = $_SESSION['id'];
$tipo = $_POST['tipo'];


$sql = "UPDATE register SET tipo = '$tipo' WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
    
    $_SESSION['tipo'] = $tipo;
    header("Location: index.php");
    exit;
} else {
    echo "Erro ao atualizar tipo: " . mysqli_error($conn);
}


mysqli_close($conn);
?>
